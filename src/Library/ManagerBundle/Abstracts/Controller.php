<?php

namespace Library\ManagerBundle\Abstracts;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as FrameworkBundleController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Library\ManagerBundle\Libraries\ResultSetFactory;

abstract class Controller extends FrameworkBundleController
{
    
    public function indexAction(Request $request)
    {
        
        try
        {
            $resultSet = $this->_getManager($request)->getSearchResults();
        }
        catch (\Exception $ex)
        {
            $resultSet = ResultSetFactory::createUnsuccessful($ex->getMessage());
        }
        
        $response = new Response($resultSet->getEncoded());
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    /**
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return \Library\ManagerBundle\Abstracts\Manager
     */
    abstract protected function _getManager(Request $request);
    
}
