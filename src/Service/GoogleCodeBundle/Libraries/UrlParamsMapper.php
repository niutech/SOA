<?php

namespace Service\GoogleCodeBundle\Libraries;

use \Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

class UrlParamsMapper implements UrlParamsMapperInterface
{

    public function getQueryParamName()
    {
        return 'q';
    }

    public function getLanguageParamName()
    {
        return 'label:';
    }
}
