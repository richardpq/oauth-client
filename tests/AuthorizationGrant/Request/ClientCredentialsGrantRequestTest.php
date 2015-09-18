<?php

namespace Tests\AuthorizationGrant\Request;

use AuthorizationGrant\Request\ClientCredentialsGrantRequest;

class ClientCredentialsGrantRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsFromAbstractRequest()
    {
        $this->assertInstanceOf("AuthorizationGrant\\Request\\AbstractGrantRequest", new ClientCredentialsGrantRequest([
            'grant_type' => 'gt'
        ]));
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testCreateClientCredentialsGrantRequestWithEmptyConstructThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters supplied are not valid
     */
    public function testCreateClientCredentialsGrantRequestWithInvalidAndValidParametersNameThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest([
            'my_key' => '',
            'grant_type' => 'gt',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type) are required, but they are no present
     */
    public function testCreateClientCredentialsGrantRequestWithoutRequiredParametersThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type) cannot be empty or null
     */
    public function testCreateClientCredentialsGrantRequestWithEmptyRequiredParametersThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest([
            'grant_type' => ''
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type) cannot be empty or null
     */
    public function testCreateClientCredentialsGrantRequestWithNullRequiredParametersThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest([
            'grant_type' => null
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @@expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetScopeWhenIsNotSetThrowException()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest([
            'grant_type' => 'gt'
        ]);

        $clientCredentialsGrantRequest->getScope();
    }

    public function testGetParametersWhenCreatingFullClientCredentialsGrantRequest()
    {
        $clientCredentialsGrantRequest = new ClientCredentialsGrantRequest([
            'grant_type' => 'gt',
            'scope' => 'scp'
        ]);

        $this->assertEquals('gt', $clientCredentialsGrantRequest->getGrantType());
        $this->assertEquals('scp', $clientCredentialsGrantRequest->getScope());
        $this->assertEquals(2, count($clientCredentialsGrantRequest->getRequestParameters()));
    }
}
