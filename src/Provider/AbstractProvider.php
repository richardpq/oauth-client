<?php

namespace Provider;

abstract class AbstractProvider
{
    abstract protected function getAuthorizationURL();
    abstract protected function getAccessTokenUrl();
    abstract protected function getApiBaseUrl();
}
