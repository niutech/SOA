<?php

namespace Service\GoogleCodeBundle\Libraries;

use \Library\ManagerBundle\Abstracts\UrlParamsMapper as UrlParamsMapperAbstract;

class UrlParamsMapper extends UrlParamsMapperAbstract
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
