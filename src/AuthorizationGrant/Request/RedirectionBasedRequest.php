<?php

namespace AuthorizationGrant\Request;

use AuthorizationGrant\Request\AbstractGrantRequest;

class RedirectionBasedRequest extends AbstractGrantRequest
{
    const RESPONSE_TYPE = 'response_type';
    const CLIENT_ID = 'client_id';
    const REDIRECT_URI = 'redirect_uri';
    const SCOPE = 'scope';
    const STATE = 'state';

    public function __construct($parameters)
    {
        parent::__construct($parameters);
    }

    /**
     * @return mixed
     */
    public function getResponseType()
    {
        return $this->getRequestParameter(self::RESPONSE_TYPE);
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
    public function getRedirectUri()
    {
        return $this->getRequestParameter(self::REDIRECT_URI);
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->getRequestParameter(self::SCOPE);
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->getRequestParameter(self::STATE);
    }

    /**
     * @return array
     */
    protected function getRequiredParameters()
    {
        return [
            self::RESPONSE_TYPE,
            self::CLIENT_ID,
        ];
    }

    /**
     * @return array
     */
    protected function getValidParametersNames()
    {
        return [
            self::RESPONSE_TYPE,
            self::CLIENT_ID,
            self::REDIRECT_URI,
            self::SCOPE,
            self::STATE
        ];
    }
}
