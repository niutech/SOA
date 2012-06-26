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
            'query_string' => 'query=mock-query-123456&lang=php'
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
                ->setQuery('q', 'mock-query-123456');

        $this->assertEquals($query, $this->_manager->getQuery());
    }
    
    /**
     * @test 
     */
    public function getSearchResults()
    {
        $resultSet = $this->_manager->getSearchResults();
        
        $this->assertInstanceOf('\Library\ManagerBundle\Libraries\ResultSet', $resultSet);
        $this->assertTrue($resultSet->success);
        $this->assertCount(3, $resultSet->results);
        $this->assertNull($resultSet->message);
    }
    
    /**
     * @test 
     */
    public function cacheWorksCorrectly()
    {
        $sha1 = sha1(mktime());
        
        $hash = md5('https://github.com/search?repo=&langOverride=&start_value=1&type=Code&q=' . $sha1 . '&language=php');
        $cacheFile = __DIR__ . '/../../../../../app/cache/searchcache/' . $hash;
        
        if (file_exists($cacheFile))
            unlink ($cacheFile);
        
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=' . $sha1 . '&lang=php'
        ));
        
        $manager = new ManagerAbstractMock($request);
        
        $manager->getSearchResults();
        $cacheFileTime = filectime($cacheFile); 
        
        sleep(1);
        
        $manager->getSearchResults();
        
        $this->assertEquals($cacheFileTime, filectime($cacheFile), 'File overwritten, problem with cache.');
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
