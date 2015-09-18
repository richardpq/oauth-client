<?php

namespace AuthorizationGrant;

abstract class AbstractGrant
{
    abstract protected function getName();

    public function __toString()
    {
        return $this->getName();
    }
}
