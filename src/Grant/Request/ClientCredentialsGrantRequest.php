<?php

namespace RichardPQ\OAuth2\Client\Grant\Request;

class ClientCredentialsGrantRequest extends AbstractGrantRequest
{
    const GRANT_TYPE = 'grant_type';
    const SCOPE = 'scope';

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
    public function getGrantType()
    {
        return $this->getRequestParameter(self::GRANT_TYPE);
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->getRequestParameter(self::SCOPE);
    }

    /**
     * @return array
     */
    protected function getValidParametersNames()
    {
        return [
            self::GRANT_TYPE,
            self::SCOPE
        ];
    }

    /**
     * @return array
     */
    protected function getRequiredParameters()
    {
        return [
            self::GRANT_TYPE,
        ];
    }
}
