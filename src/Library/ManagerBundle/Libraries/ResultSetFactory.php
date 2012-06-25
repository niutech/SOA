<?php

namespace Library\ManagerBundle\Libraries;

class ResultSetFactory
{
    
    /**
     *
     * @param string $message
     * @param string $query
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public static function createUnsuccessful($message, $query)
    {
        $resultSet = new ResultSet(false);

        return $resultSet->setMessage($message)->setQuery($query);
    }

}
