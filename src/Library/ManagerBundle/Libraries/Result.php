<?php

namespace Library\ManagerBundle\Libraries;

class Result
{
    /**
     * @var string 
     */
    public $title;
    
    /**
     * @var string 
     */
    public $url;
    
    /**
     * @var string 
     */
    public $code;

    public function __construct($title, $url, $code)
    {
        $this->title = $title;
        $this->url = $url;
        $this->code = $code;
    }
    
}
