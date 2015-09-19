<?php

namespace Provider;

abstract class AbstractResource
{
    abstract protected function getAuthorizationURL();
    abstract protected function getAccessTokenUrl();
    abstract protected function getApiBaseUrl();
}
