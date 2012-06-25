<?php

namespace Library\ManagerBundle\Libraries;

use \Library\ManagerBundle\Libraries\Query;

class ResultSetFactory
{
    
    /**
     *
     * @param string $message
     * @param \Library\ManagerBundle\Libraries\Query $query
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public static function createUnsuccessful($message, Query $query)
    {
        $resultSet = new ResultSet(false);

        return $resultSet->setMessage($message)->setQuery($query);
    }

}
