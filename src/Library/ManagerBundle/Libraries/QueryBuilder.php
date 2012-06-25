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

        return $query
                ->setLanguage($urlParamsMapper->getLanguageParamName(), $request->get($urlParamsMapper->getLanguageParamName()))
                ->setQuery($urlParamsMapper->getQueryParamName(), $request->get($urlParamsMapper->getQueryParamName()));
    }

}
