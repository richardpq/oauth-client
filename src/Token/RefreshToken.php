<?php

namespace RichardPQ\OAuth2\Client\Token;

use RichardPQ\OAuth2\Client\Token\AbstractToken;

class RefreshToken extends AbstractToken
{
    public function __construct($tokenValue)
    {
        parent::__construct($tokenValue);
    }
}
