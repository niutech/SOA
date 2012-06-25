<?php

namespace Library\ManagerBundle\Libraries;

use Symfony\Component\HttpFoundation\Request;
use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class QueryBuilder
{

    /**
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param \Library\ManagerBundle\Interfaces\UrlParamsMapper $urlParamsMapper
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public static function fromRequest(Request $request, UrlParamsMapperInterface $urlParamsMapper)
    {
        $query = new Query();
        $params = array();
        
        parse_str(urldecode($request->get('query_string')), $params);
        
        return $query
                ->setQuery($urlParamsMapper->getQueryParamName(), isset($params['query']) ? $params['query'] : '')
                ->setLanguage($urlParamsMapper->getLanguageParamName(), isset($params['lang']) ? $params['lang'] : '');
    }

}
