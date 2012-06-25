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
        $query = new Query();
        $query->setLanguage('l', 'php')
              ->setQuery('q', 'symfony');
        
        $encoded = ResultSetFactory::createUnsuccessful('Failure', $query)->getEncoded();
        $expected = '{"success":false,"message":"Failure","language":"php","results":null,"query":"q=symfony&l=php"}';
        
        $this->assertEquals($expected, $encoded);
    }
 
}
