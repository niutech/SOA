<?php

namespace Service\GithubBundle\Tests\Libraries;

class ParserTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @var \Service\GithubBundle\Libraries\Parser
     */
    private $_parser;
    
    protected function setUp()
    {
        $this->_parser = new \Service\GithubBundle\Libraries\Parser();
    }

    /**
     * @test 
     */
    public function implementsParserInterface()
    {
        $this->assertInstanceOf('\Library\ParserBundle\Interfaces\Parser', $this->_parser);
    }
    
    
}
