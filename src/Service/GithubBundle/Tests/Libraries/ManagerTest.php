<?php

namespace Service\GithubBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @var \Service\GithubBundle\Libraries\Manager
     */
    private $_manager;
    
    protected function setUp()
    {
        $this->_manager = new \Service\GithubBundle\Libraries\Manager(new Request());
    }

    /**
     * @test 
     */
    public function extendsManagerAbstract()
    {
        $this->assertInstanceOf('\Library\ManagerBundle\Abstracts\Manager', $this->_manager);
    }
    
}
