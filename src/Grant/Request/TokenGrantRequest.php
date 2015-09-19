<?php

namespace RichardPQ\OAuth2\Client\Grant\Request;

class TokenGrantRequest extends AbstractGrantRequest
{
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const GRANT_TYPE = 'grant_type';
    const CODE = 'code';
    const REDIRECT_URI = 'redirect_uri';

    /**
     * @param array $parameters
     */
    public function __construct($parameters)
    {
        parent::__construct($parameters);
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->getRequestParameter(self::CLIENT_ID);
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->getRequestParameter(self::CLIENT_SECRET);
    }

    /**
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->getRequestParameter(self::GRANT_TYPE);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->getRequestParameter(self::CODE);
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->getRequestParameter(self::REDIRECT_URI);
    }

    /**
     * @return array
     */
    protected function getValidParametersNames()
    {
        return [
            self::CLIENT_ID,
            self::CLIENT_SECRET,
            self::GRANT_TYPE,
            self::CODE,
            self::REDIRECT_URI
        ];
    }

    /**
     * @return array
     */
    protected function getRequiredParameters()
    {
        return [
            self::CLIENT_ID,
            self::CLIENT_SECRET,
            self::GRANT_TYPE,
            self::CODE,
        ];
    }
}
