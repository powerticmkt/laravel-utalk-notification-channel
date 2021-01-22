<?php

namespace Powertic\Utalk\Exceptions;

class InvalidConfiguration extends \Exception
{
    function __construct()
    {
        parent::__construct('To send notification via Utalk you need to add `token` in the `utalk` key of `config.services`.');
    }
}
