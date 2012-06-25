<?php

namespace Library\ManagerBundle\Tests;

use \Library\ManagerBundle\Libraries\Result;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\ResultSet;

class ResultSetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @param mixed $param 
     * @dataProvider invalidSuccessParamProvider
     * @expectedException \Library\ManagerBundle\Exception
     */
    public function newWithInvalidSuccessParam($param)
    {
        new ResultSet($param);
    }
    
    public static function invalidSuccessParamProvider()
    {
        return array(
            array(null),
            array(1),
            array(new \stdClass()),
            array(array())
        );
    }
    
    /**
     * @test 
     */
    public function settersWorkCorrectly()
    {
        $message = 'Everything went ok.';
        $query = $this->_createQuery();
        $results = array(
            new Result('a', 'b', 'c', 'd'),
            new Result('1', '2', '3', '4')
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setMessage($message)
                  ->setQuery($query)
                  ->setResults($results);
        
        $refClass = new \ReflectionClass($resultSet);
        
        $successProperty = $refClass->getProperty('_success');
        $successProperty->setAccessible(true);
        
        $messageProperty = $refClass->getProperty('_message');
        $messageProperty->setAccessible(true);
        
        $queryProperty = $refClass->getProperty('_query');
        $queryProperty->setAccessible(true);
        
        $languageProperty = $refClass->getProperty('_language');
        $languageProperty->setAccessible(true);
        
        $resultsProperty = $refClass->getProperty('_results');
        $resultsProperty->setAccessible(true);
        
        
        $this->assertTrue($successProperty->getValue($resultSet));
        $this->assertEquals($message, $messageProperty->getValue($resultSet));
        $this->assertEquals($query, $queryProperty->getValue($resultSet));
        $this->assertEquals('plgpsql', $languageProperty->getValue($resultSet));
        $this->assertEquals($results, $resultsProperty->getValue($resultSet));
    }
    
    /**
     * @test 
     */
    public function getEncoded()
    {
        $message = 'Everything went ok.';
        $query = $this->_createQuery();
        $results = array(
            new Result('a', 'b', 'c', 'd'),
            new Result('1', '2', '3', '4')
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setMessage($message)
                  ->setQuery($query)
                  ->setResults($results);
        
        $encoded = $resultSet->getEncoded();
        $expected = '{"success":true,"message":"Everything went ok.","query":"query=Something&lang=plgpsql","language":"plgpsql",'
                  . '"results":[{"title":"a","url":"b","code":"c","language":"d"},{"title":"1","url":"2","code":"3","language":"4"}]}';
        
        $this->assertEquals($expected, $encoded);
    }
    
    /**
     * @test 
     * @expectedException \Library\ManagerBundle\Exception
     */
    public function setResultsWithInvalidResults()
    {
        $results = array(
            new Result('a', 'b', 'c', 'd'),
            new \stdClass()
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setResults($results);
    }
    
    /**
     *
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    private function _createQuery()
    {
        $query = new Query();
        
        $query->setLanguage('lang', 'plgpsql')
              ->setQuery('query', 'Something');
        
        return $query;
    }
}
