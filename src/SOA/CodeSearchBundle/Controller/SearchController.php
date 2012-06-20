<?php

namespace SOA\CodeSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    
    public function indexAction()
    {
        $res = array();
        $query = $this->getRequest()->query->get("q");
        if($query) {
            $soap = new \Zend_Soap_Client($this->getRequest()->getUriForPath("/search")."?wsdl");
            $res = $soap->search($query);
        }
        return $this->render('CodeSearchBundle:Search:index.html.php', array('res' => $res));
    }
}
