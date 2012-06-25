<?php

namespace Library\ManagerBundle\Libraries;

use \Library\ManagerBundle\Exception as ManagerException;

class ResultSet
{

    /**
     * @var bool
     */
    private $_success;
    
    /**
     * @var string 
     */
    private $_message;
    
    /**
     * @var string 
     */
    private $_query;
    
    /**
     * @var string 
     */
    private $_language;

    /**
     * @var \Library\ManagerBundle\Libraries\Result[]
     */
    private $_results;

    /**
     *
     * @param bool $success
     * @throws \Library\ManagerBundle\Exception
     */
    public function __construct($success)
    {
        if (!is_bool($success))
            throw new ManagerException('ResultSet must have "success" parameter set.');

        $this->_success = $success;
    }
    
    /**
     * 
     * @param string $message
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function setMessage($message)
    {
        $this->_message = $message;
        
        return $this;
    }
    
    /**
     *
     * @param string $query
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function setQuery($query)
    {
        $this->_query = $query;
        
        return $this;
    }
    
    /**
     *
     * @param string $language
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
        
        return $this;
    }
    
    /**
     *
     * @param array $results
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     * @throws \Library\ManagerBundle\Exception
     */
    public function setResults(array $results)
    {
        foreach ($results as $result)
        {
            if ('Library\ManagerBundle\Libraries\Result' !== get_class($result))
                throw new ManagerException('Each element of ResultSet must be an instance of Library\ManagerBundle\Libraries\Result');
        }
        
        $this->_results = $results;
        
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getEncoded()
    {
        return json_encode(array(
            'success'   => $this->_success,
            'message'   => $this->_message,
            'query'     => $this->_query,
            'language'  => $this->_language,
            'results'   => $this->_results
        ));
    }

}
