<?php

namespace Server\CodeSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Server\CodeSearchBundle\Libraries\SoapFacade;

class SearchController extends Controller
{

    public function indexAction()
    {
        if ($this->getRequest()->query->has("wsdl"))
        {
            $soap = new \Zend_Soap_AutoDiscover("Zend_Soap_Wsdl_Strategy_ArrayOfTypeComplex");
            
            $soap->setUri($this->getRequest()->getUriForPath("/search"))
                 ->setClass('\Server\CodeSearchBundle\Libraries\SoapFacade');
        } 
        else
        {
            $soap = new \Zend_Soap_Server($this->getRequest()->getUri() . "?wsdl");
            
            $soap->setObject($this->get('SoapFacade'));
        }
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        
        ob_start();
        $soap->handle();
        $response->setContent(ob_get_clean());
        
        return $response;
    }

}
