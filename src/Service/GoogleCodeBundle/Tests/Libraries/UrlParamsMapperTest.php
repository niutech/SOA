<?php

namespace Service\GoogleCodeBundle\Tests\Libraries;

class UrlParamsMapperTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @var \Service\GoogleCodeBundle\Libraries\UrlParamsMapper
     */
    private $_mapper;
    
    protected function setUp()
    {
        $this->_mapper = new \Service\GoogleCodeBundle\Libraries\UrlParamsMapper();
    }

    /**
     * @test 
     */
    public function implementsUrlParamsMapperInterface()
    {
        $this->assertInstanceOf('\Library\ManagerBundle\Interfaces\UrlParamsMapper', $this->_mapper);
    }
    
    /**
     * @test 
     */
    public function getQueryParamName()
    {
        $this->assertEquals('q', $this->_mapper->getQueryParamName());
    }
    
    /**
     * @test 
     */
    public function getLanguageParamName()
    {
        $this->assertEquals('label:', $this->_mapper->getLanguageParamName());
    }
}
