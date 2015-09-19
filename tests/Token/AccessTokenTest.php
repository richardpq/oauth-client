<?php

namespace RichardPQ\OAuth2\Client\Tests\Token;

use RichardPQ\OAuth2\Client\Token\AccessToken;

class AccessTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testAccessTokenExtendFromAbstractToken()
    {
        $this->assertInstanceOf("RichardPQ\\OAuth2\\Client\\Token\\AbstractToken", new AccessToken('abcdedf123456'));
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testConstructAccessTokenWithoutParametersThrowException()
    {
        $accessToken = new AccessToken();
    }

    public function testCreateAccessTokenWithJustTokenValue()
    {
        $accessToken = new AccessToken('abcdedf123456');

        $this->assertEquals('abcdedf123456', $accessToken->getTokenValue());
        $this->assertEquals('bearer', $accessToken->getTokenType());
        $this->assertNull($accessToken->getExpiresIn());
        $this->assertNull($accessToken->getScope());
    }

    public function testCreateAccessTokenWithDifferentValidTokenType()
    {
        $accessToken = new AccessToken('abcdedf123456', 'Mac');

        //Token type is transform to lowercase when creating it
        $this->assertEquals('mac', $accessToken->getTokenType());
    }

    public function testCreateAccessTokenWithArrayAsTokenThrowException()
    {

    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp #.*is not a valid Token Type$#
     */
    public function testCreateAccessTokenWithInvalidTokenType()
    {
        $accessToken = new AccessToken('abcdedf123456', 'invalid token');
    }

    public function testCreateAccessTokenWithExpirationTime()
    {
        $accessToken = new AccessToken('abcdedf123456', null, 3600);

        $this->assertEquals(3600, $accessToken->getExpiresIn());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp #.*is not a valid time value for 'expiresIn' property#
     */
    public function testCreateAccessTokenWithInvalidExpiresInValue()
    {
        $accessToken = new AccessToken('abcdedf123456', null, 'abc');
    }

    public function testCreateAccessTokenWithScope()
    {
        $accessToken = new AccessToken('abcdedf123456', null, null, "scope");

        $this->assertEquals('scope', $accessToken->getScope());

        $accessToken = new AccessToken('abcdedf123456', null, null, 123);

        $this->assertSame('123', $accessToken->getScope());
    }

    //TODO: check this (possible bug on phpunit)
    /*
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp #.*is not a valid scope value, it must be a string#

    public function testCreateAccessTokenWithInvalidScope()
    {
        $accessToken = new AccessToken('abcdedf123456', null, null, new \stdClass());
    }*/

    //TODO: check this (possible bug on phpunit)
    /*
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp #.*is not a valid scope value, it must be a string#
    public function testCreateAccessTokenWithInvalidScope()
    {
        $accessToken = new AccessToken('abcdedf123456', null, null, array());
    }*/
}
