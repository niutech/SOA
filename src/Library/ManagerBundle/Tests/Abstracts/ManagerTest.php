<?php

namespace Library\ManagerBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\Result;
use \Library\ManagerBundle\Abstracts\Manager as ManagerAbstract;
use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;
use \Library\ParserBundle\Interfaces\Parser as ParserInterface;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    private $_manager;

    protected function setUp()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=symfony&lang=php'
        ));

        $this->_manager = new ManagerAbstractMock($request);
    }

    /**
     * @test
     */
    public function getQuery()
    {
        $query = new Query();
        $query->setLanguage('language', 'php')
                ->setQuery('q', 'symfony');

        $this->assertEquals($query, $this->_manager->getQuery());
    }
    
    /**
     * @test 
     */
    public function getSearchResults()
    {
        $resultSet = $this->_manager->getSearchResults();
        
        $this->assertInstanceOf('\Library\ManagerBundle\Libraries\ResultSet', $resultSet);
        $this->assertTrue($resultSet->getSuccess());
        $this->assertCount(3, $resultSet->getResults());
        $this->assertNull($resultSet->getMessage());
        
        $query = new Query();
        $query->setLanguage('language', 'php')
                ->setQuery('q', 'symfony');
        
        $this->assertEquals($query, $resultSet->getQuery());
        $this->assertEquals('php', $resultSet->getLanguage());
    }

}

class ManagerAbstractMock extends ManagerAbstract
{

    protected function _getBaseUrl()
    {
        return 'https://github.com/search?repo=&langOverride=&start_value=1&type=Code&';
    }

    protected function _getParser()
    {
        return new ParserMock();
    }

    protected function _getUrlParamsMapper()
    {
        return new UrlParamsMapperMock();
    }

}

class UrlParamsMapperMock implements UrlParamsMapperInterface
{

    public function getQueryParamName()
    {
        return 'q';
    }

    public function getLanguageParamName()
    {
        return 'language';
    }

}

class ParserMock implements ParserInterface
{

    public function parse($content)
    {
        return array(
            new Result('a', 'a', 'a', 'a'),
            new Result('b', 'b', 'b', 'b'),
            new Result('c', 'c', 'c', 'c')
        );
    }

}
