<?php

namespace Service\GoogleCodeBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Service\GoogleCodeBundle\Libraries\Manager as GoogleCodeManager; 
use \Service\GoogleCodeBundle\Libraries\UrlParamsMapper;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @tefst 
     */
    public function extendsManagerAbstract()
    {
        $manager = new GoogleCodeManager(new Request());
        $this->assertInstanceOf('\Library\ManagerBundle\Abstracts\Manager', $manager);
    }
    
    /**
     * @tefst 
     */
    public function getSearchResultsForCorrectQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=symfony&lang=php'
        ));
        
        $manager = new GoogleCodeManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertTrue($resultSet->getSuccess());
        $this->assertEquals('php', $resultSet->getLanguage());
        $this->assertGreaterThan(0, count($resultSet->getResults()));
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('q=label%3Aphp+symfony', $resultSet->getQuery()->encode());
    }
    
    /**
     * @tefst 
     */
    public function getSearchResultsForIncorrectQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=absfduyfanbcsgfsacgf&lang=phpphpphp'
        ));
        
        $manager = new GoogleCodeManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertFalse($resultSet->getSuccess());
        $this->assertEquals('phpphpphp', $resultSet->getLanguage());
        $this->assertCount(0, $resultSet->getResults());
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('q=label%3Aphpphpphp+absfduyfanbcsgfsacgf', $resultSet->getQuery()->encode());
    }
    
    /**
     * @test 
     */
    public function getSearchResultsEmptyQuery()
    {
        $urlParamsMapper = new UrlParamsMapper();
        
        $request = new Request();
        $request->initialize(array(
            $urlParamsMapper->getQueryParamName()       => '',
            $urlParamsMapper->getLanguageParamName()    => ''
        ));
        
        $manager = new GoogleCodeManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertFalse($resultSet->getSuccess());
        $this->assertEmpty($resultSet->getLanguage());
        $this->assertCount(0, $resultSet->getResults());
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('', $resultSet->getQuery()->encode());
    }
}
