<?php

namespace Tests\AuthorizationGrant\Request;

use AuthorizationGrant\Request\TokenGrantRequest;

class TokenGrantRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsFromAbstractRequest()
    {
        $this->assertInstanceOf("AuthorizationGrant\\Request\\AbstractGrantRequest", new TokenGrantRequest([
            'client_id' => 'ci',
            'client_secret' => 'cs',
            'grant_type' => 'gt',
            'code' => 'cod',
            'redirect_uri' => 'ru'
        ]));
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testCreateTokenGrantRequestWithEmptyConstructThrowException()
    {
        $tokentGrantRequest = new TokenGrantRequest();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters supplied are not valid
     */
    public function testCreateTokenGrantRequestWithInvalidAndValidParametersNameThrowException()
    {
        $tokenGrantRequest = new TokenGrantRequest([
            'my_key' => '',
            'client_id' => 'ci',
            'client_secret' => 'cs',
            'grant_type' => 'gt',
            'code' => 'cod'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (client_id,client_secret,grant_type,code) are required, but they are no present
     */
    public function testCreateTokenGrantRequestWithoutRequiredParametersThrowException()
    {
        $tokenGrantRequest = new TokenGrantRequest(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (client_id,client_secret,grant_type,code) cannot be empty or null
     */
    public function testCreateCreateTokenGrantRequestWithEmptyRequiredParametersThrowException()
    {
        $tokenGrantRequest = new TokenGrantRequest([
            'client_id' => '',
            'client_secret' => '',
            'grant_type' => '',
            'code' => '',
            'redirect_uri' => ''
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (client_id,client_secret,grant_type,code) cannot be empty or null
     */
    public function testCreateCreateTokenGrantRequestWithNullRequiredParametersThrowException()
    {
        $tokenGrantRequest = new TokenGrantRequest([
            'client_id' => null,
            'client_secret' => null,
            'grant_type' => null,
            'code' => null
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @@expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetRedirectUriWhenIsNotSetThrowException()
    {
        $tokenGrantRequest = new TokenGrantRequest([
            'client_id' => 'ci',
            'client_secret' => 'cs',
            'grant_type' => 'gt',
            'code' => 'cod'
        ]);

        $tokenGrantRequest->getRedirectUri();
    }

    public function testGetParametersWhenCreatingFullTokenGrantRequest()
    {
        $tokenGrantRequest = new TokenGrantRequest([
            'client_id' => 'ci',
            'client_secret' => 'cs',
            'grant_type' => 'gt',
            'code' => 'cod',
            'redirect_uri' => 'uri'
        ]);

        $this->assertEquals('ci', $tokenGrantRequest->getClientId());
        $this->assertEquals('cs', $tokenGrantRequest->getClientSecret());
        $this->assertEquals('gt', $tokenGrantRequest->getGrantType());
        $this->assertEquals('cod', $tokenGrantRequest->getCode());
        $this->assertEquals('uri', $tokenGrantRequest->getRedirectUri());
        $this->assertEquals(5, count($tokenGrantRequest->getRequestParameters()));
    }
}
