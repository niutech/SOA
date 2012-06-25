<?php

namespace Service\KodersBundle\Libraries;

use \Library\ParserBundle\Interfaces\Parser as ParserInterface;
use \Library\ManagerBundle\Libraries\Result;

class Parser implements ParserInterface
{

    public function parse($content)
    {
        $results = array();
        
        $matches = array();
        
        if (preg_match('/<table cellspacing="0" rules="all" border="0" id="__gResults" style="border-width:0px;border-collapse:collapse;">(.*?)<\/table>/ims', $content, $matches))
        {
            $rows = array();
            
            if (preg_match_all('/<tr>(.*?)<\/tr>/ims', $matches[1], $rows))
            {
                foreach ($rows[1] as $row)
                {
                    $elements = array();
                    
                    if (preg_match('/<pre>(.*?)<\/pre><\/div>Language: ([^<]+).*<a href="([^"]+)">(.*?)<\/a><br \/><br \/><\/td>/ims', $row, $elements))
                    {
                        $code  = $elements[1];
                        $lang  = $elements[2];
                        $url   = 'http://www.koders.com' . $elements[3];
                        $title = trim($elements[4], './');
                        
                        $results[] = new Result($title, $url, $code, $lang);
                    }
                }
            }
                
        }
        
        return $results;
    }

}
