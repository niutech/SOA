<?php

namespace Service\GithubBundle\Libraries;

use \Library\ManagerBundle\Abstracts\Manager as ManagerAbstract;

class Manager extends ManagerAbstract
{
    
    protected function _getBaseUrl()
    {
        return 'https://github.com/search?repo=&langOverride=&start_value=1&type=Code&';
    }
    
    protected function _getParser()
    {
        return new \Service\GithubBundle\Libraries\Parser();
    }
    
    protected function _getUrlParamsMapper()
    {
        return new \Service\GithubBundle\Libraries\UrlParamsMapper();
    }
    
}
