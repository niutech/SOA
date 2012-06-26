<?php

namespace Service\GoogleCodeBundle\Tests\Libraries;

use \Service\GoogleCodeBundle\Libraries\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Library\ManagerBundle\Libraries\Query
     */
    private $_query;

    protected function setUp()
    {
        $this->_query = new Query();
    }

    /**
     * @test
     * @expectedException \Library\ManagerBundle\Exception
     */
    public function encodeWithoutQueryParameterSet()
    {
        $this->_query->encode();
    }
    
    public function encodeWithoutQueryAndLanguage()
    {
        $this->_query->setQuery('q', '')->setLanguage('label:', '');
        
        $this->assertEquals('', $this->_query->encode());
    }
    
    /**
     * @test 
     */
    public function encodeOnlyWithQuerySet()
    {
        $this->_query->setQuery('q', 'symfony');
        
        $this->assertEquals('q=symfony', $this->_query->encode());
    }
    
    /**
     * @test 
     */
    public function encodeOnlyWithLanguageSet()
    {
        $this->_query->setQuery('q', '')->setLanguage('label:', 'PHP');
        
        $this->assertEquals('q=label%3APHP', $this->_query->encode());
    }
    
    /**
     * @test 
     */
    public function encodeWithLanguageAndQuery()
    {
        $this->_query->setQuery('q', 'symfony')->setLanguage('label:', 'PHP');
        
        $this->assertEquals('q=label%3APHP+symfony', $this->_query->encode());
    }
}
