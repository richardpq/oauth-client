<?php

namespace RichardPQ\OAuth2\Client\Tests\Request;

use RichardPQ\OAuth2\Client\Grant\Request\ROPCGrantRequest;

class ROPCGrantRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsFromAbstractRequest()
    {
        $this->assertInstanceOf(
            "RichardPQ\\OAuth2\\Client\\Grant\\Request\\AbstractGrantRequest",
            new ROPCGrantRequest(['grant_type' => 'gt', 'username' => 'usr', 'password' => 'pwd'])
        );
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testCreateROPCGrantRequestRequestWithEmptyConstructThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters supplied are not valid
     */
    public function testCreateROPCGrantRequestRequestWithInvalidAndValidParametersNameThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest([
            'my_key' => '',
            'grant_type' => 'gt',
            'username' => 'usr',
            'password' => 'pwd'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type,username,password) are required, but they are no present
     */
    public function testCreateROPCGrantRequestRequestWithoutRequiredParametersThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (username,password) are required, but they are no present
     */
    public function testCreateROPCGrantRequestRequestWithJustGrantTypeThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest(['grant_type' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type,password) are required, but they are no present
     */
    public function testCreateROPCGrantRequestRequestWithJustUsernameThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest(['username' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type,username) are required, but they are no present
     */
    public function testCreateROPCGrantRequestRequestWitJustPasswordThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest(['password' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type,username,password) cannot be empty
     */
    public function testCreateROPCGrantRequestWithEmptyRequiredParametersThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest([
            'grant_type' => '',
            'username' => '',
            'password' => ''
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (grant_type,username,password) cannot be empty or null
     */
    public function testCreateROPCGrantRequestWithNullRequiredParametersThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest([
            'grant_type' => null,
            'username' => null,
            'password' => null
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @@expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetScopeWhenIsNotSetThrowException()
    {
        $ropcGrantRequest = new ROPCGrantRequest([
            'grant_type' => 'gt',
            'username' => 'usr',
            'password' => 'pwd'
        ]);

        $ropcGrantRequest->getScope();
    }

    public function testGetParametersWhenCreatingFullROPCGrantRequest()
    {
        $ropcGrantRequest = new ROPCGrantRequest([
            'grant_type' => 'gt',
            'username' => 'usr',
            'password' => 'pwd',
            'scope' => 'scp'
        ]);

        $this->assertEquals('gt', $ropcGrantRequest->getGrantType());
        $this->assertEquals('usr', $ropcGrantRequest->getUserName());
        $this->assertEquals('pwd', $ropcGrantRequest->getPassword());
        $this->assertEquals('scp', $ropcGrantRequest->getScope());
        $this->assertEquals(4, count($ropcGrantRequest->getRequestParameters()));
    }
}
