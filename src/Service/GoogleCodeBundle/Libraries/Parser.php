<?php

namespace Service\GoogleCodeBundle\Libraries;

use \Library\ParserBundle\Interfaces\Parser as ParserInterface;
use \Library\ManagerBundle\Libraries\Result;

class Parser implements ParserInterface
{

    public function parse($content)
    {
        $results = array();
        
        $matches = array();
        
        if (preg_match('/<div id="serp">(.*?)<div style="clear:both">/ims', $content, $matches))
        {
            $rows = array();
            
            if (preg_match_all('/<table>(.*?)<\/table>/ims', $matches[1], $rows))
            {
                foreach ($rows[1] as $row)
                {
                    $elements = array();
                    
                    if (preg_match('/<a onmousedown=.*?href="([^"]+)".*?style="font-size:medium">(.*?)<\/a>.*?<\/span><br\/>(.*?)<br\/>.*?<span class="labels">(.*?)<\/span>/ims', $row, $elements))
                    {
                        $url   = 'http://code.google.com' . $elements[1];
                        $title = trim($elements[2]);
                        $code  = trim($elements[3]);
                        $lang  = '';
                        
                        $tags = array();
                        
                        if (preg_match_all('/<a[^>]+>(.*?)<\/a>/ims', $elements[4], $tags))
                            $lang = $tags[1][0];
                        
                        $results[] = new Result($title, $url, $code, $lang);
                    }
                }
            }
                
        }
        
        return $results;
    }

}
