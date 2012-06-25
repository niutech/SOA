<?php

namespace Service\GithubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Service\GithubBundle\Libraries\Manager as GithubManager;
use Library\ManagerBundle\Libraries\ResultSetFactory;

class SearchController extends Controller
{
    
    public function indexAction(Request $request)
    {
        
        try
        {
            $manager = new GithubManager($request);
            $resultSet = $manager->getSearchResults();
        }
        catch (\Library\ManagerBundle\Exception $ex)
        {
            $resultSet = ResultSetFactory::createUnsuccessful($ex->getMessage(), $manager->getQuery());
        }
        
        $response = new Response($resultSet->getEncoded());
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}
