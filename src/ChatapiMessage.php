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
     * The chatapi namespace. (Required if method is sendTemplate)
     *
     * @var string
     */
    public $namespacetemplate;

    /**
     * The chatapi template. (Required if method is sendTemplate)
     *
     * @var string
     */
    public $template;

    /**
     * The chatapi language. (Required if method is sendTemplate)
     *
     * @var string
     */
    public $language;

    /**
     * The chatapi params. (Optional if method is sendTemplate)
     *
     * @var string
     */
    public $params;

    /**
     * The chatapi format. (form-params, json) default form-params
     *
     * @var string
     */
    public $format;

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

    /**
     * Set the chatapi namespace.
     *
     * @param  string $namespacetemplate
     */
    public function namespacetemplate($namespacetemplate = '')
    {
        $this->namespacetemplate = $namespacetemplate;
    }

    /**
     * Set the chatapi template.
     *
     * @param  string $template
     */
    public function template($template = '')
    {
        $this->template = $template;
    }

    /**
     * Set the chatapi language.
     *
     * @param  string $language
     */
    public function language($language = '')
    {
        $this->language = $language;
    }

    /**
     * Set the chatapi params.
     *
     * @param  string $params
     */
    public function params($params = '')
    {
        $this->params = $params;
    }

    /**
     * Set the chatapi format.
     *
     * @param  string $format
     */
    public function format($format)
    {
        if (in_array($format, ['form-params', 'json'])) {
            $this->format = $format;
        }

        $this->format = 'form-params';
    }
}
