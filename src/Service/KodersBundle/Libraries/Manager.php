<?php

namespace Service\KodersBundle\Libraries;

use \Library\ManagerBundle\Abstracts\Manager as ManagerAbstract;

class Manager extends ManagerAbstract
{
    
    protected function _getBaseUrl()
    {
        return 'http://www.koders.com/default.aspx?search.x=0&search.y=0&li=*&scope=&';
    }
    
    protected function _getParser()
    {
        return new \Service\KodersBundle\Libraries\Parser();
    }
    
    protected function _getUrlParamsMapper()
    {
        return new \Service\KodersBundle\Libraries\UrlParamsMapper();
    }
    
}
