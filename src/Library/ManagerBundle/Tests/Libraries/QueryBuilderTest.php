<?php

namespace Library\ManagerBundle\Tests;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\QueryBuilder;
use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test 
     */
    public function fromRequest()
    {
        $request = new Request();
        $request->initialize(array(
            'l' => 'C',
            'q' => 'serialize'
        ));
        
        $urlParamsMapper = new UrlParamsMapperInterfaceMock();
        
        $query = QueryBuilder::fromRequest($request, $urlParamsMapper);
        
        $this->assertEquals('q=serialize&l=C', $query->encode());
    }

}

class UrlParamsMapperInterfaceMock implements UrlParamsMapperInterface
{
    public function getQueryParamName()
    {
        return 'q';
    }

    public function getLanguageParamName()
    {
        return 'l';
    }
}
