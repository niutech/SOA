<?php

namespace SOA\CodeSearchBundle\Services;

class SearchService {
    
    private $backends = array("github", "koders");
    
    /**
     *
     * @param string $query
     * @return array 
     */
    public function search($query) {
        $res = array();
        foreach($this->backends as $backend) {
            $soap = new \Zend_Soap_Client("http://localhost/CodeSearchEngine/web/app_dev.php/".$backend."?wsdl");
            $cur = $soap->search($query);
            $res = array_merge($res, $cur);
        }
        return $res;
    }

}
