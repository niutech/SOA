<?php

namespace Service\GoogleCodeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    
    /**
     * @var Service\GoogleCodeBundle\Tests\Controller\Client
     */
    private $_client;
    
    protected function setUp()
    {
        $this->_client = self::createClient();
    }
    
    /**
     * @test 
     */
    public function indexActionWithNoParameters()
    {
        $this->_client->request('GET', $this->_getUrl());
        
        $this->assertEquals('application/json', $this->_client->getResponse()->headers->get('Content-Type'));
        $this->assertEquals('{"success":false,"message":null,"results":[]}', $this->_client->getResponse()->getContent());
    }
    
    /**
     * @test 
     * @dataProvider validParamsProvider
     */
    public function indexActionWithQueryString($lang, $query)
    {
        $this->_client->request('GET', $this->_getUrl(), array('query_string' => $query));
        
        $this->assertEquals('application/json', $this->_client->getResponse()->headers->get('Content-Type'));
        
        $response = json_decode($this->_client->getResponse()->getContent());

        $this->assertEquals(1, $response->success);
        $this->assertEquals('', (string) $response->message);
        $this->assertGreaterThan(0, count($response->results));
    }
    
    public static function validParamsProvider()
    {
        return array(
            array('php', 'query=symfony&lang=php'),
            array('', 'query=symfony')
        );
    }
        
    /**
     * @test 
     */
    public function indexActionWithoutQuery()
    {
        $this->_client->request('GET', $this->_getUrl(), array('query_string' => 'query=&lang=php'));
        
        $this->assertEquals('application/json', $this->_client->getResponse()->headers->get('Content-Type'));
        
        $response = json_decode($this->_client->getResponse()->getContent());

        $this->assertFalse($response->success);
        $this->assertEquals('', (string) $response->message);
        $this->assertEquals(0, count($response->results));
    }
    
    private function _getUrl()
    {
        return '/search/google_code';
    }
}
