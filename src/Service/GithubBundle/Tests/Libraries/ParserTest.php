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
    
    /**
     * @test
     * @dataProvider contentProvider
     */
    public function parseHtmlContent($filename)
    {
        $content = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $filename . '.html');
        
        $results = $this->_parser->parse($content);
        array_walk($results, function(&$r) { $r = (array) $r; });
        
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'expected' . DIRECTORY_SEPARATOR . $filename . '.php';
        
        $this->assertEquals(${$filename}, $results);
    }
    
    public static function contentProvider()
    {
        return array(
            array(
                'cpp_boost',
            ),
            array(
                'perl_irc',
            ),
            array(
                'php_symfony',
            ),
            array(
                'empty_result',
            ),
            array(
                'empty_query_empty_result',
            ),
        );
    }
}
