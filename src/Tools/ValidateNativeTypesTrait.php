<?php

namespace RichardPQ\OAuth2\Client\Tools;

trait ValidateNativeTypesTrait
{
    protected function isAValidStringType(&$value)
    {
        if (is_array($value) || is_object($value) || !settype($value, 'string')) {
            return false;
        }

        return true;
    }
}
