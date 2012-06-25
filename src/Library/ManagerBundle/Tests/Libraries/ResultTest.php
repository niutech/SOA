<?php

namespace Library\ManagerBundle\Tests;

use \Library\ManagerBundle\Libraries\Result;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @test
     */
    public function constructorSetsProperiesCorrectly()
    {
        $title = 'Font-Awesome';
        $url = 'https://github.com/FortAwesome/Font-Awesome';
        $code = 'The iconic font designed for use with Twitter Bootstrap';
        $lang = 'JAVA';
        
        $result = new Result($title, $url, $code, $lang);
        
        $this->assertEquals($title, $result->title);
        $this->assertEquals($url, $result->url);
        $this->assertEquals($code, $result->code);
        $this->assertEquals($lang, $result->language);
    }
    
    /**
     * @test
     */
    public function afterEncodingAndDecodingObjectProperly()
    {
        $title = 'Font-Awesome';
        $code = 'The iconic font designed for use with Twitter Bootstrap';
        $lang = 'PHP';
        
        $result = new Result($title, null, $code, $lang);
        
        $encoded = json_encode($result);
        
        $this->assertEquals('{"title":"' . $title . '","url":null,"code":"' . $code . '","language":"' . $lang . '"}', $encoded);
        
        $decoded = json_decode($encoded);
        
        $this->assertEquals($title, $decoded->title);
        $this->assertEquals(null, $decoded->url);
        $this->assertEquals($code, $decoded->code);
        $this->assertEquals($lang, $result->language);
    }
    
}
