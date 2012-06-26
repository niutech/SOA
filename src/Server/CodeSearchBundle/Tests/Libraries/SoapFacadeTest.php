<?php

namespace Server\CodeSearchBundle\Tests\Libraries;

use \Server\CodeSearchBundle\Libraries\SoapFacade;

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

        $this->assertTrue($result->success);
        $this->assertNull($result->message);
        $this->assertInternalType('array', $result->results);
        $this->assertGreaterThan(0, count($result->results));
    }

    /**
     * @test 
     */
    public function cacheWorksCorrectly()
    {
        $cacheFile = __DIR__ . '/../../../../../app/cache/servercache/' . md5('zend') . md5('php');
        
        if (file_exists($cacheFile))
            unlink($cacheFile);

        $this->_facade->search('zend', 'php');
        
        $cacheFileTime = filectime($cacheFile);

        $this->_facade->search('zend', 'php');

        $this->assertEquals($cacheFileTime, filectime($cacheFile), 'File overwritten, problem with cache.');
    }

}
