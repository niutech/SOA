<?php

namespace Library\ManagerBundle\Libraries;

use \Library\ManagerBundle\Exception as ManagerException;

class Query
{

    /**
     * @var string
     */
    private $_language;

    /**
     * @var string
     */
    private $_languageParam;

    /**
     * @var string
     */
    private $_query;

    /**
     * @var string
     */
    private $_queryParam;

    /**
     *
     * @param string $paramName
     * @param string $language
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public function setLanguage($paramName, $language)
    {
        if (!empty($paramName))
        {
            $this->_languageParam = $paramName;
            $this->_language = $language;
        }
        
        return $this;
    }

    /**
     *
     * @param string $paramName
     * @param string $query
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public function setQuery($paramName, $query)
    {
        if (!empty($paramName))
        {
            $this->_queryParam = $paramName;
            $this->_query = $query;
        }
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->_language;
    }
    
    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     *
     * @return string
     * @throws \Library\ManagerBundle\Exception
     */
    public function encode()
    {
        $params = array();
        
        if (is_string($this->_queryParam) && is_string($this->_query))
            $params[$this->_queryParam] = $this->_query;
        
        if (is_string($this->_languageParam) && is_string($this->_language))
            $params[$this->_languageParam] = $this->_language;
        
        if (0 === count($params))
            throw new ManagerException('Either query or language must be set.');
        
        return http_build_query($params);
    }
}
