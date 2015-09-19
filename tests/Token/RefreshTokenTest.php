<?php

namespace RichardPQ\OAuth2\Client\Tests\Token;

use RichardPQ\OAuth2\Client\Token\RefreshToken;

class RefreshTokenTest extends \PHPUnit_Framework_TestCase
{

    public function testRefreshTokenExtendFromAbstractToken()
    {
        $this->assertInstanceOf("RichardPQ\\OAuth2\\Client\\Token\\AbstractToken", new RefreshToken('abcdedf123456'));
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testRefreshTokenCreationWithEmptyConstructThrowException()
    {
        $refreshToken = new RefreshToken();
    }

    public function testRefreshTokenCreationWithTokenValue()
    {
        $refreshToken = new RefreshToken('abcdedf123456');

        $this->assertEquals('abcdedf123456', $refreshToken->getTokenValue());
    }
}
