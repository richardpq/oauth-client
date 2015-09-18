<?php

namespace Token;

use Token\AbstractToken;

class RefreshToken extends AbstractToken
{
    public function __construct($tokenValue)
    {
        parent::__construct($tokenValue);
    }
}
