<?php

namespace RichardPQ\OAuth2\Client\Grant\Response;

use RichardPQ\OAuth2\Client\Tools\RequiredParametersTrait;
use RichardPQ\OAuth2\Client\Tools\ParameterizedTrait;

class AuthorizationResponse
{
    use RequiredParametersTrait;
    use ParameterizedTrait;

    const CODE = 'code';
    const STATE = 'state';

    /**
     * @param array $responseParameters
     */
    protected function __construct(array $responseParameters)
    {
        $this->requiredParameters = $this->getRequiredParameters();

        $this->validParametersNames = $this->getValidParametersNames();

        $this->validateRequiredParameters($responseParameters);

        if (!$this->areParametersNamesValid(array_keys($responseParameters))) {
            throw new \InvalidArgumentException("Parameters supplied are not valid");
        }

        $this->parameters = $responseParameters;
    }

    /**
     * @return array
     */
    public function getResponseParameters()
    {
        return $this->getParameters();
    }

    /**
     * @param string $parameterName
     * @throw \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getResponseParameter($parameterName)
    {
        return $this->getParameter($parameterName);
    }

    /**
     * @return array
     */
    protected function getValidParametersNames()
    {
        return [
            self::CODE,
            self::STATE
        ];
    }

    /**
     * @return array
     */
    protected function getRequiredParameters()
    {
        return [
           self::CODE
        ];
    }
}
