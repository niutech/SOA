<?php

namespace Service\KodersBundle\Libraries;

use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class UrlParamsMapper implements UrlParamsMapperInterface
{

    public function getQueryParamName()
    {
        return 's';
    }

    public function getLanguageParamName()
    {
        return 'la';
    }
    
    public function mapLanguage($language)
    {
        if ('c++' === strtolower($language))
            return 'cpp';
        
        return $language;
    }
}
