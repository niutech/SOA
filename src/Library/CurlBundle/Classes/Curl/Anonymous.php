<?php

namespace Library\CurlBundle\Classes\Curl;

class Anonymous extends \Library\CurlBundle\Classes\Curl
{

    public function __construct($timeout = 5, $iterations = 3)
    {
        parent::__construct($timeout, $iterations);
        
        curl_setopt($this->_curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
        curl_setopt($this->_curl, CURLOPT_REFERER, 'http://www.google.com');
    }

}
