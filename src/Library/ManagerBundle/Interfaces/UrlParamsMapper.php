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
    
    /**
     * @param string $language
     * @return string 
     */
    public function mapLanguage($language);
    
}
