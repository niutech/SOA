<?php

namespace Service\GithubBundle\Tests\Libraries;

class UrlParamsMapperTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @var \Service\GithubBundle\Libraries\UrlParamsMapper
     */
    private $_mapper;
    
    protected function setUp()
    {
        $this->_mapper = new \Service\GithubBundle\Libraries\UrlParamsMapper();
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
        $this->assertEquals('language', $this->_mapper->getLanguageParamName());
    }
}
