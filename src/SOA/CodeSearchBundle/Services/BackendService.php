<?php

namespace SOA\CodeSearchBundle\Services;

abstract class BackendService {

    /**
     * @param string $query
     * @return SOA\CodeSearchBundle\Services\ResultSet
     */
    abstract public function search($query);

}
