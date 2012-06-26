<?php

namespace Library\ManagerBundle\Libraries;

use \Library\ManagerBundle\Libraries\Query;

class ResultSetFactory
{
    
    /**
     *
     * @param string $message
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public static function createUnsuccessful($message)
    {
        $resultSet = new ResultSet(false);
        $resultSet->message = $message;
        
        return $resultSet;
    }

}
