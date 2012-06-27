<?php

namespace Service\GithubBundle\Libraries;

use \Library\ManagerBundle\Abstracts\UrlParamsMapper as UrlParamsMapperAbstract;

class UrlParamsMapper extends UrlParamsMapperAbstract
{

    public function getQueryParamName()
    {
        return 'q';
    }

    public function getLanguageParamName()
    {
        return 'language';
    }
}
