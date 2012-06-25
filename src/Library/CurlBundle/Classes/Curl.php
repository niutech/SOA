<?php

namespace Library\CurlBundle\Classes;

use \Library\CurlBundle\Classes\Curl\Exception as CurlException;

class Curl
{

    /**
     * @var cUrl handle
     */
    protected $_curl;

    /**
     * @var integer
     */
    private $_iterations;

    /**
     * @var integer
     */
    private $_iterationsLeft;

    /**
     * @param integer $timeout
     * @param integer $iterations 
     */
    public function __construct($timeout = 2, $iterations = 2)
    {
        $this->_iterations = $this->_iterationsLeft = $iterations;
        $this->_curl = curl_init();

        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $this->_getHeaders());
        curl_setopt($this->_curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($this->_curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->_curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYPEER, false);
    }

    /**
     * @param string $url
     * @return string
     * @throws \Library\CurlBundle\Classes\Curl\Exception
     */
    public function getPage($url)
    {
        if (-1 === --$this->_iterationsLeft)
            throw new CurlException('Failed when trying to get: ' . $url . '. ' . $this->getErrno() . ': ' . $this->getError());

        curl_setopt($this->_curl, CURLOPT_URL, rawurldecode($url));

        $result = curl_exec($this->_curl);
        
        if (!$this->_hasErrors($result))
        {
            $this->_iterationsLeft = $this->_iterations;
            
            return @iconv(mb_detect_encoding($result), 'utf-8', $result);
        }
        
        return $this->getPage($url);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return curl_error($this->_curl);
    }

    /**
     * @return string
     */
    public function getErrno()
    {
        return curl_errno($this->_curl);
    }

    public function __destruct()
    {
        curl_close($this->_curl);
    }
    
    /**
     * @param string $result 
     * @return boolean
     */
    protected function _hasErrors($result)
    {
        return 0 !== strlen($this->getError()) || '' === htmlspecialchars($result);
    }

    /**
     * @return array
     */
    private function _getHeaders()
    {
        return array(
            "Accept: text/xml,application/xml,application/xhtml+xml,text/html,q=0.9,text/plain,q=0.8,image/png,*/*,q=0.5",
            "Cache-Control: max-age=0",
            "Connection: keep-alive",
            "Keep-Alive: 300",
            "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
            "Accept-Language: en-us,en;q=0.5",
            "Pragma: ",
        );
    }

}
