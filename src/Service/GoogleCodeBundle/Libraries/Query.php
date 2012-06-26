<?php

namespace Service\GoogleCodeBundle\Libraries;

use \Library\ManagerBundle\Libraries\Query as BaseQuery;
use \Library\ManagerBundle\Exception as ManagerException;

class Query extends BaseQuery
{

    public function encode()
    {
        if (empty($this->_queryParam))
            throw new ManagerException('Query param must be set.');
        
        if (empty($this->_language) && empty($this->_query))
            return '';
        
        $query = $this->_queryParam . '=';
        
        if (!empty($this->_language))
            $query .= urlencode($this->_languageParam . $this->_language);
        
        if (!empty($this->_language) && !empty($this->_query))
            $query .= '+';
        
        if (!empty($this->_query))
            $query .= urlencode($this->_query);
        
        return $query;
    }

}
