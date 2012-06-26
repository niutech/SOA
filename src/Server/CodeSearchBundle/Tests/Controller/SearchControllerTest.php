<?php

namespace Service\CodeSearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    
    /**
     * @test 
     */
    public function wsdlFile()
    {
        $client = static::createClient();
        $client->request('GET', $this->_getUrl() . '?wsdl');
        
        $this->assertEquals('text/xml; charset=UTF-8', $client->getResponse()->headers->get('Content-Type'));
        
        $xml = $client->getResponse()->getContent();
        
        $this->assertContains('<xsd:complexType name="ArrayOf\Library\ManagerBundle\Libraries\Result">', $xml);
        $this->assertContains('<xsd:complexType name="\Library\ManagerBundle\Libraries\Result">', $xml);
        $this->assertContains('<xsd:complexType name="\Library\ManagerBundle\Libraries\ResultSet">', $xml);
        $this->assertContains('<xsd:element name="results" type="tns:ArrayOf\Library\ManagerBundle\Libraries\Result" nillable="true"/>', $xml);
        $this->assertContains('<portType name="\Server\CodeSearchBundle\Libraries\SoapFacadePort">', $xml);
        $this->assertContains('<service name="\Server\CodeSearchBundle\Libraries\SoapFacadeService">', $xml);
    }
    
    /**
     * @test 
     */
    public function searchUsingWsdlFile()
    {
        $soapClient = new \Zend_Soap_Client($this->_getDomain() . $this->_getUrl() . '?wsdl');
        
        $result = $soapClient->search('symfony', 'php');
        
        $this->assertInstanceOf('stdClass', $result);
        $this->assertTrue($result->success);
        $this->assertNull($result->message);
        $this->assertInternalType('array', $result->results);
        $this->assertGreaterThan(0, count($result->results));
    }
    
    private function _getUrl()
    {
        return '/search';
    }
    
    /**
     * @todo Refactor it to work in a proper way ASAP
     */
    private function _getDomain()
    {
        if (strpos(__FILE__, 'dev.codesearch') !== false)
            return 'http://dev.codesearch';
        
        return 'http://code-search.pl';
    }
}
