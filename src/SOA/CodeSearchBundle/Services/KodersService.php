<?php

namespace SOA\CodeSearchBundle\Services;

class KodersService extends BackendService {
    
    /**
     *
     * @param string $query
     * @return SOA\CodeSearchBundle\Services\ResultSet 
     */
    public function search($query) {
        $results = new ResultSet($query);
        $arr = array(); //of Result
        $client = new \Zend_Http_Client('http://www.koders.com/default.aspx?s='.urlencode($query).'&la=*&li=*');
        $res = $client->request();
        $dom = new \DOMDocument();
        @$dom->loadHTML($res->getBody());
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//table[@id="__gResults"]/tr[not(@class="paginator")]/td');
        if(!empty($nodes)) foreach($nodes as $node) {
            $a = $xpath->query("a", $node);
            $c = $xpath->query("div/pre", $node);
            $result = new Result();
            $result->title = $a->item(1)->nodeValue." » ".$a->item(3)->nodeValue; //Project » Filename
            $result->url = 'https://www.koders.com'.$a->item(3)->getAttribute('href');
            $result->code = $c->item(0)->C14N();
            $arr[] = $result;
        }
        $results->results = $arr;
        return $results;
    }
    
}
