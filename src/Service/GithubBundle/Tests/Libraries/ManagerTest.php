<?php

namespace Service\GithubBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Service\GithubBundle\Libraries\Manager as GithubManager; 
use \Service\GithubBundle\Libraries\UrlParamsMapper;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
 
    /**
     * @test 
     */
    public function extendsManagerAbstract()
    {
        $manager = new GithubManager(new Request());
        $this->assertInstanceOf('\Library\ManagerBundle\Abstracts\Manager', $manager);
    }
    
    /**
     * @test
     */
    public function getQuery()
    {
        $urlParamsMapper = new UrlParamsMapper();
        
        $request = new Request();
        $request->initialize(array(
            $urlParamsMapper->getQueryParamName()       => 'symfony',
            $urlParamsMapper->getLanguageParamName()    => 'php'
        ));
        
        $query = new Query();
        $query->setLanguage($urlParamsMapper->getLanguageParamName(), 'php')
              ->setQuery($urlParamsMapper->getQueryParamName(), 'symfony');
        
        $manager = new GithubManager($request);
        
        $this->assertEquals($query, $manager->getQuery());
    }
    
    /**
     * @tdstxx 
     */
    public function getSearchResults()
    {
        $urlParamsMapper = new UrlParamsMapper();
        
        $request = new Request();
        $request->initialize(array(
            $urlParamsMapper->getQueryParamName()       => 'symfony',
            $urlParamsMapper->getLanguageParamName()    => 'php'
        ));
        
        $manager = new GithubManager($request);
        
        echo $manager->getSearchResults();
    }
}
