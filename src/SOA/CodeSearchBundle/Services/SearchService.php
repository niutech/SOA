<?php

namespace SOA\CodeSearchBundle\Services;

class SearchService {
    
    private $backends = array("github", "koders");
    
    /**
     *
     * @param string $query
     * @return SOA\CodeSearchBundle\Services\ResultSet
     */
    public function search($query) {
        $res = new ResultSet($query);
        $arr = array(); //of Result
        foreach($this->backends as $backend) {
            $soap = new \Zend_Soap_Client("http://localhost/CodeSearchEngine/web/app_dev.php/".$backend."?wsdl");
            $cur = $soap->search($query); //return ResultSet
            $arr = array_merge($arr, $cur->results);
        }
        $res->results = array_unique($arr, SORT_REGULAR); //remove duplicates
        return $res;
    }

}
