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
     * The chatapi method. (optional)
     *
     * @var string
     */
    public $method;

    /**
     * The chatapi file. (Required if method is sendFile)
     *
     * @var string
     */
    public $file;

    /**
     * The chatapi filename. (Required if method is sendFile)
     *
     * @var string
     */
    public $filename;

    /**
     * The chatapi caption. (Required if method is sendFile)
     *
     * @var string
     */
    public $caption;

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

    /**
     * Set the chatapi method.
     *
     * @param  string $method
     */
    public function method($method)
    {
        $this->method = $method;
    }

    /**
     * Set the chatapi file.
     *
     * @param  string $file
     */
    public function file($file = '')
    {
        $this->file = $file;
    }

    /**
     * Set the chatapi filename.
     *
     * @param  string $filename
     */
    public function filename($filename = '')
    {
        $this->filename = $filename;
    }

    /**
     * Set the chatapi caption.
     *
     * @param  string $caption
     */
    public function caption($caption = '')
    {
        $this->caption = $caption;
    }
}
