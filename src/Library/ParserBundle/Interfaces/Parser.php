<?php

namespace Library\ParserBundle\Interfaces;

interface Parser
{
    
    /**
     * @param string $content
     * @return array 
     */
    public function parse($content);
}
