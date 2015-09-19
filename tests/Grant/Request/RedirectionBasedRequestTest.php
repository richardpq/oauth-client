<?php

namespace RichardPQ\OAuth2\Client\Tests\Request;

use RichardPQ\OAuth2\Client\Grant\Request\RedirectionBasedRequest;

class RedirectionBasedRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsFromAbstractRequest()
    {
        $this->assertInstanceOf(
            "RichardPQ\\OAuth2\\Client\\Grant\\Request\\AbstractGrantRequest",
            new RedirectionBasedRequest(['response_type' => 'resp','client_id' => 'id'])
        );
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testCreateRedirectionBasedRequestWithEmptyConstructThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters supplied are not valid
     */
    public function testCreateRedirectionBasedRequestWithInvalidAndValidParametersNameThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest([
            'my_key' => '',
            'client_id' => 'id',
            'response_type' => 'res'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (response_type,client_id) are required, but they are no present
     */
    public function testCreateRedirectionBasedRequestWithoutRequiredParametersThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (client_id) are required, but they are no present
     */
    public function testCreateRedirectionBasedRequestWithJustResponseTypeThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest(['response_type' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (response_type) are required, but they are no present
     */
    public function testCreateRedirectionBasedRequestWithJustClientIdThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest(['client_id' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (response_type,client_id) cannot be empty or null
     */
    public function testCreateRedirectionBasedRequestWithEmptyRequiredParametersTypeThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest(['client_id' => '', 'response_type' => '']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Parameters: (response_type,client_id) cannot be empty or null
     */
    public function testCreateRedirectionBasedRequestWithNullRequiredParametersTypeThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest(['client_id' => null, 'response_type' => null]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @@expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetScopeWhenIsNotSetShouldThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest([
            'response_type' => 'resp',
            'client_id' => 'id'
        ]);

        $redirectBasedRequest->getScope();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetStateWhenIsNotSetThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest([
            'response_type' => 'resp',
            'client_id' => 'id'
        ]);

        $redirectBasedRequest->getState();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @@expectedExceptionMessageRegExp #.*is not a valid parameter or hasn't been set yet#
     */
    public function testGetRedirectUriWhenIsNotSetThrowException()
    {
        $redirectBasedRequest = new RedirectionBasedRequest([
            'response_type' => 'resp',
            'client_id' => 'id'
        ]);

        $redirectBasedRequest->getRedirectUri();
    }

    public function testGetParametersWhenCreatingARedirectBaseRequest()
    {
        $redirectBasedRequest = new RedirectionBasedRequest([
            'response_type' => 'resp',
            'client_id' => 'id',
            'redirect_uri' => 'uri',
            'scope' => 'sco',
            'state' => 'sta'
        ]);

        $this->assertEquals(5, count($redirectBasedRequest->getRequestParameters()));
        $this->assertEquals('resp', $redirectBasedRequest->getResponseType());
        $this->assertEquals('id', $redirectBasedRequest->getClientId());
        $this->assertEquals('uri', $redirectBasedRequest->getRedirectUri());
        $this->assertEquals('sco', $redirectBasedRequest->getScope());
        $this->assertEquals('sta', $redirectBasedRequest->getState());
    }
}
