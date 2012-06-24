<?php

namespace Library\CurlBundle\Tests\Classes\Curl;

class AnonymousTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test 
     */
    public function userAgentIsSetCorrectly()
    {
        $curl = new \Library\CurlBundle\Classes\Curl\Anonymous();

        $response = $curl->getPage('http://www.useragentstring.com/');

        $this->assertContains('Googlebot/2.1 (+http://www.google.com/bot.html)', $response);
    }

}
