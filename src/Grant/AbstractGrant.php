<?php

namespace RichardPQ\OAuth2\Client\Grant;

abstract class AbstractGrant
{
    abstract protected function getName();

    public function __toString()
    {
        return $this->getName();
    }
}
