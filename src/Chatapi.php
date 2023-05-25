<?php
namespace NotificationChannels\Chatapi;

use GuzzleHttp\Client;
use NotificationChannels\Chatapi\ChatapiConfig;
use NotificationChannels\Chatapi\ChatapiMessage;
use NotificationChannels\Chatapi\Exceptions\CouldNotSendNotification;

class Chatapi
{
    /**
     * @var ChatapiConfig
     */
    private $config;

    /**
     * Chatapi constructor.
     *
     * @param ChatapiConfig   $config
     */
    public function __construct(ChatapiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Send an sms message using the Chatapi Service.
     *
     * @param ChatapiMessage $message
     * @param string           $to
     * @return \Chatapi\MessageInstance
     */
    public function sendMessage(ChatapiMessage $message, $to)
    {
        $params = [
            'phone' => $to,
            'body'  => trim($message->content),
        ];
        $method = "sendMessage";
        if ($message->method) {
            $method = $message->method;
        }
        if ($message->url) {
            $url   = $message->url;
            $token = $message->token;
        } else {
            if (!$url = $this->config->getURL()) {
                throw CouldNotSendNotification::missingURL();
            }
            $token = $this->config->getToken();
        }

        if ($message->format) {
            $format = $message->format;
        } else {
            $format = $this->config->getFormat();
        }

        $url   = trim($url);
        $token = trim($token);

        $cliente = new Client;
        switch ($method) {
            case 'sendMessage':
                $response = $cliente->request('POST', $url . "sendMessage?token=" . $token, [
                    $format => $params, 'timeout' => 25]);
                break;
            case 'sendFile':{
                    if ($message->filename) {
                        $params['filename'] = $message->filename;
                    } else {
                        abort(422, "Nombre de archivo es requerido para este método");
                    }

                    if ($message->caption) {
                        $params['caption'] = $message->caption;
                    }

                    $response = $cliente->request('POST', $url . "sendFile?token=" . $token, [
                        $format => $params, 'timeout' => 25]);
                }
                break;
            case 'sendTemplate':{
                    if ($message->namespacetemplate) {
                        $params['namespace'] = $message->namespacetemplate;
                    } else {
                        abort(422, "Namespace es requerido para este método");
                    }

                    if ($message->template) {
                        $params['template'] = $message->template;
                    } else {
                        abort(422, "Template es requerido para este método");
                    }

                    if ($message->language) {
                        $params['language'] = $message->language;
                    } else {
                        abort(422, "Language es requerido para este método");
                    }

                    if ($message->params) {
                        $params['params'] = $message->params;
                    }

                    $response = $cliente->request('POST', $url . "sendTemplate?token=" . $token, [
                        $format => $params, 'timeout' => 25]);
                }
                break;
        }
        $html = (string) $response->getBody();

        return $response;
    }

}
