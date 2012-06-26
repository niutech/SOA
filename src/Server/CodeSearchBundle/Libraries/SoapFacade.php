<?php

namespace Server\CodeSearchBundle\Libraries;

use Library\ManagerBundle\Libraries\ResultSet;
use Symfony\Component\HttpFoundation\Request;

class SoapFacade
{

    /**
     * 
     * @param string $query
     * @param string $language
     * @return \Library\ManagerBundle\Libraries\ResultSet
     */
    public function search($query, $language)
    {
        $results = array();
        
        foreach ($this->_getRegistredServices() as $service)
        {
            // Magic, do not touch.
            // Fucking ugly but provides incredibly huge speedup :]
            $request = new Request();
            $request->initialize(array(
                'query_string' => 'query=' . $query . '&lang=' . $language
            ));
            
            $controllerName = '\Service\\' . $service . '\Controller\SearchController';
            $controller = new $controllerName();
            
            $results[] = json_decode($controller->indexAction($request)->getContent());
        }
        
        return $this->_createCumulativeResultSet($results);
    }
    
    /**
     * 
     * @param array $resultSets
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    private function _createCumulativeResultSet(array $resultSets)
    {
        $success = false;
        $results = array();
        
        foreach ($resultSets as $resultSet)
        {
            if ($resultSet->success)
            {
                $success = true;
                $results = array_merge($results, $resultSet->results);
            }
        }
                
        $cumulativeResultSet = new ResultSet($success);
        $cumulativeResultSet->results = $results;
        
        return $cumulativeResultSet;
    }

    /**
     * 
     * @return array 
     */
    private function _getRegistredServices()
    {
        return array(
            'GithubBundle',
            'GoogleCodeBundle',
            'KodersBundle'
        );
    }

}
