<?php

namespace RichardPQ\OAuth2\Client\Grant\Request;

use RichardPQ\OAuth2\Client\Tools\RequiredParametersTrait;
use RichardPQ\OAuth2\Client\Tools\ParameterizedTrait;

abstract class AbstractGrantRequest
{
    use RequiredParametersTrait;
    use ParameterizedTrait;

    /**
     * @param array $requestParameters
     */
    protected function __construct(array $requestParameters)
    {
        $this->requiredParameters = $this->getRequiredParameters();

        $this->validParametersNames = $this->getValidParametersNames();

        $this->validateRequiredParameters($requestParameters);

        if (!$this->areParametersNamesValid(array_keys($requestParameters))) {
            throw new \InvalidArgumentException("Parameters supplied are not valid");
        }

        $this->parameters = $requestParameters;
    }

    /**
     * @return array
     */
    public function getRequestParameters()
    {
        return $this->getParameters();
    }

    /**
     * @param string $parameterName
     * @throw \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getRequestParameter($parameterName)
    {
        return $this->getParameter($parameterName);
    }
}
