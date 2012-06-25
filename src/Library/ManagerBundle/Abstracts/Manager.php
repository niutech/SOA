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

    public function __construct(Request $request)
    {
        $this->_query = QueryBuilder::fromRequest($request, $this->_getUrlParamsMapper());
    }
    
    /**
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return ResultSet 
     */
    public function getSearchResults()
    {
        $curl = new AnonymousCurl();
        
        return $this->_createResultSet(
            $this->_getParser()->parse(
                $curl->getPage($this->_getBaseUrl() . $this->_query->encode())
            )
        );
    }
    
    private function _createResultSet(array $parsedData)
    {
        $resultSet = new ResultSet(true);
        
        // @todo Convert data from array
        
        return $resultSet;
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
