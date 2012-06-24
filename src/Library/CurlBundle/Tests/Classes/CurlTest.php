<?php

namespace Library\CurlBundle\Tests\Classes;

class CurlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Library\CurlBundle\Classes\Curl
     */
    private $_curl;

    protected function setUp()
    {
        $this->_curl = new \Library\CurlBundle\Classes\Curl();
    }

    /**
     * @test 
     * @dataProvider validUrlProvider
     */
    public function curlReturnsHtmlOfExistingWebsite($url, $text)
    {
        $this->assertContains($text, $this->_curl->getPage($url));
        $this->assertEmpty($this->_curl->getError());
        $this->assertEquals(0, $this->_curl->getErrno());
    }

    public static function validUrlProvider()
    {
        return array(
            array('onet.pl', 'Onet.pl'),
            array('agh.edu.pl', 'Akademia'),
            array('wp.pl', 'Wirtualna Polska')
        );
    }

    /**
     * @test
     */
    public function curlReturnsCorrectErrorValuesForNonExistingUrl()
    {
        try
        {
            $this->_curl->getPage('non-existing.url');
            $this->fail('Expected \Library\CurlBundle\Classes\Curl\Exception, nothing has been thrown.');
        } 
        catch(\Library\CurlBundle\Classes\Curl\Exception $ex)
        {
            $this->assertEquals(6, $this->_curl->getErrno());
        }
    }
    
}
