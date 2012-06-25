<?php

namespace Library\ManagerBundle\Interfaces;

interface UrlParamsMapper
{
    
    /**
     * @return string 
     */
    public function getQueryParamName();
    
    /**
     * @return string 
     */
    public function getLanguageParamName();
    
}
