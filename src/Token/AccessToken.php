<?php

namespace RichardPQ\OAuth2\Client\Token;

class AccessToken extends AbstractToken
{
    const TOKEN_TYPE_BEARER = 'bearer';
    const TOKEN_TYPE_MAC = 'mac';

    /** @var  string $tokenType */
    private $tokenType;

    /** @var int $expiresIn */
    private $expiresIn;

    /** @var string $scope */
    private $scope;

    /** @var string state */
    private $state;

    protected $validTokenTypes = [self::TOKEN_TYPE_BEARER, self::TOKEN_TYPE_MAC];

    /**
     * @param $tokenValue
     * @param null $tokenType
     * @param null $expiresIn
     * @param null $scope
     * @param null $state
     */
    public function __construct($tokenValue, $tokenType = null, $expiresIn = null, $scope = null, $state = null)
    {
        parent::__construct($tokenValue);

        if (is_null($tokenType)) {
            $tokenType = self::TOKEN_TYPE_BEARER;
        }

        $tokenTypeLCase = strtolower($tokenType);

        if (!$this->verifyTokenType($tokenTypeLCase)) {
            throw new \InvalidArgumentException("'$tokenType' is not a valid Token Type");
        }

        if (!is_null($expiresIn) && !is_int($expiresIn)) {
            throw new \InvalidArgumentException("'$expiresIn' is not a valid time value for 'expiresIn' property");
        }

        if (!is_null($scope) && !$this->isAValidStringType($scope)) {
            throw new \InvalidArgumentException("'$scope' is not a valid scope value, it must be a string");
        }

        $this->tokenType = $tokenTypeLCase;
        $this->expiresIn = $expiresIn;
        $this->scope = $scope;
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param $tokenType
     *
     * @return bool
     */
    protected function verifyTokenType($tokenType)
    {
        return in_array($tokenType, $this->validTokenTypes);
    }

    public function getState()
    {
        return $this->state;
    }
}
