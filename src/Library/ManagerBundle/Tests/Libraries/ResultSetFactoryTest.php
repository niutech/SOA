<?php

namespace Library\ManagerBundle\Tests;

use \Library\ManagerBundle\Libraries\ResultSet;
use \Library\ManagerBundle\Libraries\ResultSetFactory;

class ResultSetTestFactory extends \PHPUnit_Framework_TestCase
{

    /**
     * @test 
     */
    public function createUnsuccessful()
    {
        $encoded = ResultSetFactory::createUnsuccessful('Failure', 'q=Awesome&type=Everything')->getEncoded();
        $expected = '{"success":false,"message":"Failure","query":"q=Awesome&type=Everything","language":null,"results":null}';
        
        $this->assertEquals($expected, $encoded);
    }
 
}
