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
     * @var \Library\ManagerBundle\Libraries\Query 
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
     * @return bool
     */
    public function getSuccess()
    {
        return $this->_success;
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
    * @return string
    */
    public function getMessage()
    {
        return $this->_message;
    }
    
    /**
     *
     * @param \Library\ManagerBundle\Libraries\Query $query
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function setQuery(Query $query)
    {
        $this->_query = $query;
        $this->_language = $query->getLanguage();
        
        return $this;
    }
    
    /**
     * @return \Library\ManagerBundle\Libraries\Query
     */
    public function getQuery()
    {
        return $this->_query;
    }
    
    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->_language;
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
     * @return \Library\ManagerBundle\Libraries\Result[]
     */
    public function getResults()
    {
        return $this->_results;
    }
    
    /**
     *
     * @return string
     */
    public function getEncoded()
    {
        $data = array(
            'success'   => $this->_success,
            'message'   => $this->_message,
            'language'  => $this->_language,
            'results'   => $this->_results
        );
        
        try 
        {
            $data['query'] = $this->_query->encode();
        }
        catch (\Exception $ex)
        {
            $data['success'] = false;
            $data['message'] = $ex->getMessage();
        }
        
        return json_encode($data);
    }

}
