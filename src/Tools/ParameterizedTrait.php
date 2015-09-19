<?php

namespace RichardPQ\OAuth2\Client\Tools;

trait ParameterizedTrait
{
    /** @var  array $parameters */
    protected $parameters;

    /** @var array $validParametersKeys */
    protected $validParametersNames;

    /**
     * @return array
     */
    abstract protected function getValidParametersNames();

    /**
     * @return array
     */
    abstract protected function getRequiredParameters();

    /**
     * @return array
     */
    protected function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $parameterName
     * @throw \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getParameter($parameterName)
    {
        if (array_key_exists($parameterName, $this->parameters)) {
            return $this->parameters[$parameterName];
        } else {
            throw new \InvalidArgumentException("'$parameterName' is not a valid parameter or hasn't been set yet");
        }
    }

    /**
     * @param $parametersToValidate
     *
     * @return bool
     */
    protected function areParametersNamesValid(array $parametersToValidate)
    {
        return array_diff($parametersToValidate, $this->validParametersNames) ? false : true;
    }
}
