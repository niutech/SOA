<?php

namespace Service\KodersBundle\Tests\Libraries;

class UrlParamsMapperTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @var \Service\KodersBundle\Libraries\UrlParamsMapper
     */
    private $_mapper;
    
    protected function setUp()
    {
        $this->_mapper = new \Service\KodersBundle\Libraries\UrlParamsMapper();
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
        $this->assertEquals('s', $this->_mapper->getQueryParamName());
    }
    
    /**
     * @test 
     */
    public function getLanguageParamName()
    {
        $this->assertEquals('la', $this->_mapper->getLanguageParamName());
    }
    
    /**
     * @test
     * @dataProvider languageProvider
     */
    public function mapLanguage($lang, $expected)
    {
        $this->assertEquals($expected, $this->_mapper->mapLanguage($lang));
    }
    
    public static function languageProvider()
    {
        return array(
            array('php', 'php'),
            array('c++', 'cpp'),
            array('C++', 'cpp')
        );
    }
}
