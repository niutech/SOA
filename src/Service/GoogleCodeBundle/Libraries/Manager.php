<?php

namespace Service\GoogleCodeBundle\Libraries;

use \Service\GoogleCodeBundle\Libraries\Query as GoogleCodeQuery;
use \Library\ManagerBundle\Abstracts\Manager as ManagerAbstract;

class Manager extends ManagerAbstract
{
    
    protected function _getBaseUrl()
    {
        return 'http://code.google.com/hosting/search?';
    }
    
    protected function _getParser()
    {
        return new \Service\GoogleCodeBundle\Libraries\Parser();
    }
    
    protected function _getUrlParamsMapper()
    {
        return new \Service\GoogleCodeBundle\Libraries\UrlParamsMapper();
    }
    
    protected function _getQuery()
    {
        return new GoogleCodeQuery();
    }
}
