<?php
namespace NotificationChannels\Chatapi;

class ChatapiConfig
{
    /**
     * @var array
     */
    private $config;

    /**
     * ChatapiConfig constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Get the account sid.
     *
     * @return string
     */
    public function getURL()
    {
        return $this->config['url'];
    }

    public function getToken()
    {
        return $this->config['token'];
    }

    public function getFormat()
    {
        if (array_key_exists('format', $this->config)) {
            if (in_array($this->config['format'], ['form_params', 'json'])) {
                return $this->config['format'];
            }
        }

        return 'form_params';
    }
}
