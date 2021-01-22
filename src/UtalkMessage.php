<?php

namespace Powertic\Utalk;

class UtalkMessage
{

    /**
     * The Message of the request.
     *
     * @var string
     */
    protected $message;

    /**
     * @param string $message
     *
     * @return static
     */
    public static function create($message = '')
    {
        return new static($message);
    }

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * Set the message to be JSON encoded.
     *
     * @param string $message
     *
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'message' => $this->message,
        ];
    }
}
