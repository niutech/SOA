<?php

namespace Library\ManagerBundle\Tests\Libraries;

use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Library\ManagerBundle\Libraries\ResultSetFactory;

class ResultSetTestFactory extends \PHPUnit_Framework_TestCase
{

    /**
     * @test 
     */
    public function createUnsuccessful()
    {
        $encoded = ResultSetFactory::createUnsuccessful('Failure')->getEncoded();
        $expected = '{"success":false,"message":"Failure","results":null}';
        
        $this->assertEquals($expected, $encoded);
    }
 
}
