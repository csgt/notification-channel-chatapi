<?php
namespace NotificationChannels\Chatapi;

class ChatapiMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;

    /**
     * The chatapi url. (optional)
     *
     * @var string
     */
    public $url;

    /**
     * The chatapi token. (optional)
     *
     * @var string
     */
    public $token;

    /**
     * Create a message object.
     * @param string $content
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * Create a new message instance.
     *
     * @param  string $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the chatapi url.
     *
     * @param  string $url
     */
    public function url($url)
    {
        $this->url = $url;
    }

    /**
     * Set the chatapi token.
     *
     * @param  string $token
     */
    public function token($token)
    {
        $this->token = $token;
    }
}
