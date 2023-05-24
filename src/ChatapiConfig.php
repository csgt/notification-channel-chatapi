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
        return $this->config['format'] ? $this->config['format'] : 'form-params';
    }
}
