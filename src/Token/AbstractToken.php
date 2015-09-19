<?php
namespace RichardPQ\OAuth2\Client\Token;

use RichardPQ\OAuth2\Client\Tools\ValidateNativeTypesTrait;

abstract class AbstractToken
{
    use ValidateNativeTypesTrait;

    /** @var  string $token */
    protected $tokenValue;

    protected function __construct($tokenValue)
    {
        if (!$this->isAValidStringType($tokenValue)) {
            throw new \InvalidArgumentException("'' must be present");
        }
        $this->tokenValue = $tokenValue;
    }

    /**
     * @return string
     */
    public function getTokenValue()
    {
        return $this->tokenValue;
    }
}
