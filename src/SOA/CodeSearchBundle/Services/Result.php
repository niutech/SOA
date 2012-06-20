<?php

namespace SOA\CodeSearchBundle\Services;

class Result {
    
    /**
     *
     * @var string 
     */
    public $title;
    
    /**
     *
     * @var string 
     */
    public $url;
    
    /**
     *
     * @var string 
     */
    public $code;

    /**
     *
     * @param string $title
     * @param string $url
     * @param string $code 
     */
    function __construct($title, $url, $code) {
        $this->title = $title;
        $this->url = $url;
        $this->code = $code;
    }

}
