<?php

namespace Service\KodersBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Service\KodersBundle\Libraries\Manager as KodersManager; 
use \Service\KodersBundle\Libraries\UrlParamsMapper;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @test 
     */
    public function extendsManagerAbstract()
    {
        $manager = new KodersManager(new Request());
        $this->assertInstanceOf('\Library\ManagerBundle\Abstracts\Manager', $manager);
    }
    
    /**
     * @test 
     */
    public function getSearchResultsForCorrectQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=symfony&lang=php'
        ));
        
        $manager = new KodersManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertTrue($resultSet->getSuccess());
        $this->assertEquals('php', $resultSet->getLanguage());
        $this->assertGreaterThan(0, count($resultSet->getResults()));
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('s=symfony&la=php', $resultSet->getQuery()->encode());
    }
    
    /**
     * @test 
     */
    public function getSearchResultsForIncorrectQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=absfduyfanbcsgfsacgf&lang=phpphpphp'
        ));
        
        $manager = new KodersManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertFalse($resultSet->getSuccess());
        $this->assertEquals('phpphpphp', $resultSet->getLanguage());
        $this->assertCount(0, $resultSet->getResults());
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('s=absfduyfanbcsgfsacgf&la=phpphpphp', $resultSet->getQuery()->encode());
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
        
        $manager = new KodersManager($request);
        
        $resultSet = $manager->getSearchResults();
        
        $this->assertFalse($resultSet->getSuccess());
        $this->assertEmpty($resultSet->getLanguage());
        $this->assertCount(0, $resultSet->getResults());
        $this->assertNull($resultSet->getMessage());
        $this->assertEquals('s=&la=', $resultSet->getQuery()->encode());
    }
}
