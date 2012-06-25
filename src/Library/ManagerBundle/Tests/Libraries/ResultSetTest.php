<?php

namespace Library\ManagerBundle\Tests\Libraries;

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
    public function settersAndGettersWorkCorrectly()
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
        
        $this->assertTrue($resultSet->getSuccess());
        $this->assertEquals($message, $resultSet->getMessage());
        $this->assertEquals($query, $resultSet->getQuery());
        $this->assertEquals('plgpsql', $resultSet->getLanguage());
        $this->assertEquals($results, $resultSet->getResults());
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
