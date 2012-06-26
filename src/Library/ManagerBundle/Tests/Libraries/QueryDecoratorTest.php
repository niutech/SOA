<?php

namespace Library\ManagerBundle\Tests\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\QueryDecorator;
use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class QueryDecoratorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test 
     */
    public function decorateWithDefaultQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=serialize&lang=C'
        ));
        
        $urlParamsMapper = new UrlParamsMapperInterfaceMock();
        $queryDecorator = new QueryDecorator(new Query());
        $query = $queryDecorator->decorate($request, $urlParamsMapper);
        
        $this->assertEquals('q=serialize&l=C', $query->encode());
    }

    /**
     * @test 
     */
    public function decorateWithExtendedQuery()
    {
        $request = new Request();
        $request->initialize(array(
            'query_string' => 'query=doesnt_matter'
        ));
        
        $urlParamsMapper = new UrlParamsMapperInterfaceMock();
        $queryDecorator = new QueryDecorator(new QueryMock());
        $query = $queryDecorator->decorate($request, $urlParamsMapper);
        
        $this->assertEquals('q=label%3Aphp+sf', $query->encode());
    }

}

class QueryMock extends Query
{
    public function encode()
    {
        return http_build_query(array(
            'q' => 'label:php sf'
        ));
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
