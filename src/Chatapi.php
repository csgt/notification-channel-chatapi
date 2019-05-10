<?php
namespace NotificationChannels\Chatapi;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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

        if (!$url = $this->config->getURL()) {
            throw CouldNotSendNotification::missingURL();
        }

        $cliente = new Client;
        try {
            $response = $cliente->request('POST', $url . 'sendMessage?token=' . $this->config->getToken(), [
                'form_params' => $params, 'timeout' => 25]);

            $html = (string) $response->getBody();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw CouldNotSendNotification::errorSending(Psr7\str($e->getResponse()));
            }
            throw CouldNotSendNotification::errorSending($e->getMessage());
        }

        return $response;
    }

}
