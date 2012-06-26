<?php

namespace Library\ManagerBundle\Libraries;

use \Library\ManagerBundle\Exception as ManagerException;

class ResultSet
{

    /**
     * 
     * @var bool
     */
    public $success;
    
    /**
     * 
     * @var string 
     */
    public $message;
    
    /**
     * 
     * @var \Library\ManagerBundle\Libraries\Result[]
     */
    public $results;

    /**
     * 
     * @param bool $success
     * @throws \Library\ManagerBundle\Exception
     */
    public function __construct($success)
    {
        if (!is_bool($success))
            throw new ManagerException('ResultSet must have "success" parameter set.');

        $this->success = $success;
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
            if (!in_array(get_class($result), array('Library\ManagerBundle\Libraries\Result', 'stdClass')))
                throw new ManagerException('Each element of ResultSet must be either an instance of Library\ManagerBundle\Libraries\Result or \stdClass');
        }
        
        $this->results = $results;
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getEncoded()
    {
        return json_encode(array(
            'success'   => $this->success,
            'message'   => $this->message,
            'results'   => $this->results
        ));
    }

}
