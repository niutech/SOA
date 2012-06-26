<?php

namespace Library\ManagerBundle\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class QueryDecorator
{
    
    /**
     * @var Query
     */
    private $_query;
    
    /**
     *
     * @param Query $query 
     */
    public function __construct(Query $query)
    {
        $this->_query = $query;
    }
    
    /**
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param \Library\ManagerBundle\Interfaces\UrlParamsMapper $urlParamsMapper
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public function decorate(Request $request, UrlParamsMapperInterface $urlParamsMapper)
    {
        $params = array();
        
        parse_str(urldecode($request->get('query_string')), $params);
        
        return $this->_query
                    ->setQuery($urlParamsMapper->getQueryParamName(), isset($params['query']) ? $params['query'] : '')
                    ->setLanguage($urlParamsMapper->getLanguageParamName(), isset($params['lang']) ? $params['lang'] : '');
    }

}
