<?php

namespace Tools;

trait RequiredParametersTrait
{
    private $requiredParameters;

    /**
     * @param array $parameters
     */
    protected function validateRequiredParameters(array $parameters)
    {
        $requiredParametersNoPresent = $this->getRequiredParametersNotPresent(
            $this->requiredParameters,
            array_keys($parameters)
        );

        if ($requiredParametersNoPresent) {
            throw new \InvalidArgumentException('Parameters: ('.
                implode(',', $requiredParametersNoPresent).') are required, but they are no present');
        }

        $requiredParametersEmpty = $this->getRequiredParametersEmpty($this->requiredParameters, $parameters);

        if ($requiredParametersEmpty) {
            throw new \InvalidArgumentException('Parameters: ('.
                implode(',', $requiredParametersEmpty).') cannot be empty or null');
        }
    }

    /**
     * @param array $requiredParameters
     * @param array $actualParameters
     * @param bool|false $strict
     *
     * @return array
     */
    private function getRequiredParametersNotPresent(
        array $requiredParameters,
        array $actualParameters,
        $strict = false
    ) {

        $diff =  $strict ? array_diff($requiredParameters, $actualParameters) ||
            array_diff($actualParameters, $requiredParameters) :
            array_diff($requiredParameters, $actualParameters);

        return $diff;
    }

    /**
     * @param array $requiredParameters
     * @param array $actualParameters
     *
     * @return array
     */
    private function getRequiredParametersEmpty(array $requiredParameters, array $actualParameters)
    {
        $emptyParameters = [];

        foreach ($requiredParameters as $parameter) {
            if (empty($actualParameters[$parameter])) {
                $emptyParameters[] = $parameter;
            }
        }

        return $emptyParameters;
    }
}
