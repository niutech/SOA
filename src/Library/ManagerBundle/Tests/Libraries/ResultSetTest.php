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
    public function setAndGetResultsAndSuccess()
    {
        $results = array(
            new Result('a', 'b', 'c', 'd'),
            new Result('1', '2', '3', '4')
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setResults($results);
        
        $this->assertTrue($resultSet->success);
        $this->assertEquals($results, $resultSet->results);
    }
    
    /**
     * @test 
     */
    public function getEncoded()
    {
        $results = array(
            new Result('a', 'b', 'c', 'd'),
            new Result('1', '2', '3', '4')
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setResults($results);
        $resultSet->message     = 'Everything went ok.';
        
        $encoded = $resultSet->getEncoded();
        $expected = '{"success":true,"message":"Everything went ok.",'
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
            new \stdClass(),
            new \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException()
        );
        
        $resultSet = new ResultSet(true);
        $resultSet->setResults($results);
    }
    
}
