<?php

namespace Server\CodeSearchBundle\Libraries;

use Library\ManagerBundle\Libraries\ResultSet;
use Symfony\Component\HttpFoundation\Request;

class SoapFacade
{

    /**
     * @var array
     */
    private $_config;

    public function __construct()
    {
        $reader = new \Symfony\Component\Yaml\Yaml();
        $this->_config = $reader->parse(__DIR__ . '/../Resources/config/cache.yml');
    }

    /**
     * 
     * @param string $query
     * @param string $language
     * @return \Library\ManagerBundle\Libraries\ResultSet
     */
    public function search($query, $language)
    {
        $cacheFile = __DIR__ . '/../../../../app/cache/' . $this->_config['search_cache']['directory'] . '/' . md5($query) . md5($language);

        if ($this->_isCached($cacheFile))
            return $this->_getFromCache($cacheFile);
        
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

        $cumulativeResultSet = $this->_createCumulativeResultSet($results);
        
        $this->_cache($cumulativeResultSet, $cacheFile);
        
        return $cumulativeResultSet;
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
     * @param string $cacheFile
     * @return bool
     */
    private function _isCached($cacheFile)
    {
        return file_exists($cacheFile) && filectime($cacheFile) > time() - $this->_config['search_cache']['expiration'];
    }

    /**
     * 
     * @param string $cacheFile
     * @return array 
     */
    private function _getFromCache($cacheFile)
    {
        return json_decode(file_get_contents($cacheFile));
    }

    /**
     * 
     * @param ResultSet $resultSet
     * @param string $cacheFile 
     */
    private function _cache(ResultSet $resultSet, $cacheFile)
    {
        $dir = dirname($cacheFile);

        if (!file_exists($dir))
            mkdir($dir, '0777', true);

        file_put_contents($cacheFile, json_encode($resultSet));
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
