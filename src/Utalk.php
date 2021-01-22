<?php

namespace Powertic\Utalk;

/**
 * Class Utalk.
 */
class Utalk
{

    /**
     * Utalk API Token
     *
     * @var [string]
     */
    protected $token;

    /**
     * Utalk API Url
     *
     * @var [string]
     */
    protected $apiBaseUri;


    /**
     * Create New Utalk instance
     *
     * @param [string] $token
     */
    public function __construct($token = null)
    {
        $this->token = $token;
        $this->apiBaseUri = "https://v1.utalk.chat/send/{$token}/";
    }

    /**
     * Get Utalk Token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set Utalk Token
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get Utalk URL
     *
     * @return string
     */
    public function getApiBaseUri()
    {
        return $this->apiBaseUri;
    }
}
