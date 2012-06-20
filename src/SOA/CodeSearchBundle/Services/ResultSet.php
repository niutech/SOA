<?php

namespace SOA\CodeSearchBundle\Services;

class ResultSet {

    /**
     *
     * @var string
     */
    public $query;
    
    /**
     *
     * @var SOA\CodeSearchBundle\Services\Result[]
     */
    public $results;
    
    /**
     *
     * @param string $query 
     */
    function __construct($query) {
        $this->query = $query;
    }

}
