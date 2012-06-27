<?php

namespace Library\ManagerBundle\Abstracts;

use Symfony\Component\HttpFoundation\Request;
use \Library\CurlBundle\Classes\Curl\Anonymous as AnonymousCurl;
use \Library\ManagerBundle\Interfaces\Manager as ManagerInterface;
use \Library\ManagerBundle\Libraries\ResultSet;
use \Library\ManagerBundle\Libraries\Query;
use \Library\ManagerBundle\Libraries\QueryDecorator;

abstract class Manager
{
    
    /**
     * @var \Library\ManagerBundle\Libraries\Query
     */
    private $_query;
    
    /**
     * @var \Library\CurlBundle\Classes\Curl\Anonymous
     */
    private $_curl;
    
    /**
     * @var array
     */
    private $_config;

    /**
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request)
    {
        $queryDecorator = new QueryDecorator($this->_getQuery());
        
        $this->_query = $queryDecorator->decorate($request, $this->_getUrlParamsMapper());
        $this->_curl = new AnonymousCurl();
        
        $reader = new \Symfony\Component\Yaml\Yaml();
        $this->_config = $reader->parse(__DIR__ . '/../Resources/config/cache.yml');
    }
    
    /**
     * 
     * @return \Library\ManagerBundle\Libraries\ResultSet 
     */
    public function getSearchResults()
    {
        $url        = $this->_getBaseUrl() . $this->_query->encode();
        $results    = array();
        
        if ($url !== $this->_getBaseUrl())
        {
            $cacheFile = __DIR__ . '/../../../../app/cache/' . $this->_config['search_cache']['directory'] . '/' . md5($url);

            if ($this->_isCached($cacheFile))
                $results = $this->_getFromCache($cacheFile);
            else
            {
                $results = (array) array_unique($this->_getParser()->parse($this->_curl->getPage($url)), SORT_REGULAR);

                $this->_cache($results, $cacheFile);
            }

            $resultSet = new ResultSet(count($results) > 0);
        }
        else
            $resultSet = new ResultSet(false);
        
        return $resultSet->setResults((array) $results);
    }
    
    /**
     *
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    public function getQuery()
    {
        return $this->_query;
    }
    
    /**
     *
     * @return \Library\ManagerBundle\Libraries\Query 
     */
    protected function _getQuery()
    {
        return new Query();
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
     * @param array $results
     * @param string $cacheFile 
     */
    private function _cache(array $results, $cacheFile)
    {
        $dir = dirname($cacheFile);
        
        if (!file_exists($dir))
            mkdir($dir, '0777', true);
        
        file_put_contents($cacheFile, json_encode($results));
    }
    
    /**
     * @return string 
     */
    abstract protected function _getBaseUrl();
    
    /**
     * @return \Library\ParserBundle\Interfaces\Parser
     */
    abstract protected function _getParser();
    
    /**
     * @return \Library\ManagerBundle\Interfaces\UrlParamsMapper
     */
    abstract protected function _getUrlParamsMapper();

}
