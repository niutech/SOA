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
        $manager = new GithubManager($request);
        
        try
        {
            $result = $manager->getSearchResults();
        }
        catch (\Exception $ex)
        {
            $result = ResultSetFactory::createUnsuccessful($ex->getMessage(), $query);
        }
        
        $response = new Response($result->getEncoded());
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}
