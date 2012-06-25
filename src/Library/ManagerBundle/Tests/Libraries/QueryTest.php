<?php

namespace Library\ManagerBundle\Tests\Libraries;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @var \Library\ManagerBundle\Libraries\Query
     */
    private $_query;
    
    protected function setUp()
    {
        $this->_query = new \Library\ManagerBundle\Libraries\Query();
    }
    
    /**
     * @test 
     * @expectedException \Library\ManagerBundle\Exception
     */
    public function encodeQueryWithoutParams()
    {
        $this->_query->encode();
    }
        
    /**
     * @test 
     * @dataProvider queryParamsProvider
     */
    public function getLanguageAndQuery($langParam, $lang, $queryParam, $query, $expected)
    {
        $this->_query->setLanguage($langParam, $lang)->setQuery($queryParam, $query);
        
        $this->assertEquals($lang, $this->_query->getLanguage());
        $this->assertEquals($query, $this->_query->getQuery());
    }
    
    /**
     * @test 
     * @dataProvider queryParamsProvider
     */
    public function setParamsAndEncodeQuery($langParam, $lang, $queryParam, $query, $expected)
    {
        $this->_query->setLanguage($langParam, $lang)->setQuery($queryParam, $query);
        
        $this->assertEquals($expected, $this->_query->encode());
    }
    
    public static function queryParamsProvider()
    {
        return array(
            array(
                'l', 'php', 'q', 'symfony', 'q=symfony&l=php'
            ),
            array(
                '', '', 'q', 'symfony', 'q=symfony'
            ),
            array(
                'lang', 'JAVA', '', '', 'lang=JAVA'
            )
        );
    }
}
