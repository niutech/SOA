<?php

namespace Server\CodeSearchBundle\Tests\Libraries;

use \Server\CodeSearchBundle\Libraries\SoapFacade;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Service\GoogleCodeBundle\Libraries\Manager as GoogleCodeManager;
use \Service\GoogleCodeBundle\Libraries\UrlParamsMapper;

class SoapFacadeTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var \Server\CodeSearchBundle\Libraries\SoapFacade 
     */
    private $_facade;

    protected function setUp()
    {
        $this->_facade = new SoapFacade(new \AppKernel('test', true));
    }
    
    /**
     * @test 
     */
    public function search()
    {
        $result = $this->_facade->search('symfony', 'php');
        
        $this->assertInstanceOf('\Library\ManagerBundle\Libraries\ResultSet', $result);
        $this->assertTrue($result->success);
        $this->assertNull($result->message);
        $this->assertInternalType('array', $result->results);
        $this->assertGreaterThan(0, count($result->results));
    }

}
