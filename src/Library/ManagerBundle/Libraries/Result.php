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
    
    /**
     * @var string 
     */
    public $language;

    public function __construct($title, $url, $code, $lang)
    {
        $this->title        = $title;
        $this->url          = $url;
        $this->code         = $code;
        $this->language     = $lang;
    }
    
}
