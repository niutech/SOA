<?php

namespace Library\ManagerBundle\Abstracts;

use Symfony\Component\HttpFoundation\Request;
use \Library\CurlBundle\Classes\Curl\Anonymous as AnonymousCurl;
use \Library\ManagerBundle\Interfaces\Manager as ManagerInterface;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\QueryBuilder;

abstract class Manager
{
    
    /**
     * @var \Library\ManagerBundle\Libraries\Query
     */
    private $_query;
    
    /**
     * @var \Library\CurlBundle\Classes\Curl\Anonymous
     */
    private $_curl;

    /**
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request)
    {
        $this->_query = QueryBuilder::fromRequest($request, $this->_getUrlParamsMapper());
        $this->_curl = new AnonymousCurl();
    }
    
    /**
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function getSearchResults()
    {
        $results = $this->_getParser()->parse(
            $this->_curl->getPage($this->_getBaseUrl() . $this->_query->encode())
        );
        
        $resultSet = new ResultSet(count($results) > 0);
        
        return $resultSet
                ->setQuery($this->_query)
                ->setResults($results);
    }
    
    /**
     *
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public function getQuery()
    {
        return $this->_query;
    }
    
    /**
     * @return string 
     */
    abstract protected function _getBaseUrl();
    
    /**
     * @return \Library\ParserBundle\Interfaces\Parser
     */
    abstract protected function _getParser();
    
    /**
     * @return \Library\ManagerBundle\Interfaces\UrlParamsMapper
     */
    abstract protected function _getUrlParamsMapper();

}
