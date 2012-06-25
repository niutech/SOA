<?php

namespace Service\GithubBundle\Libraries;

use \Library\ParserBundle\Interfaces\Parser as ParserInterface;
use \Library\ManagerBundle\Libraries\Result;

class Parser implements ParserInterface
{

    public function parse($content)
    {
        $results = array();
        
        $matches = array();
        if (preg_match('/<div class="results">(.*?)<\/div>\s+<div class="pagination">/ims', $content, $matches))
        {
            $parts = explode('<div class="result">', $matches[1]);

            foreach ($parts as $part)
            {
                $part = trim($part);
                $properties = array();
                
                if (preg_match('/^<h2.*?<a href="([^"]+)">(.*?)<\/a>\s+<span>\((.*?)\)/ims', $part, $properties))
                {
                    $url    = 'https://github.com' . $properties[1];
                    $title  = $properties[2];
                    $lang   = $properties[3];
                }
                
                if (preg_match('/<div class="snippet">\s+<pre>(.*?)<\/pre>/ims', $part, $properties))
                {
                    $code   = $properties[1];
                }
                
                if (!empty($url))
                    $results[] = new Result($title, $url, $code, $lang);
            }
        }
        
        return $results;
    }

}
