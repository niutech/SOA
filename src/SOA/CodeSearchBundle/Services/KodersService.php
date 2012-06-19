<?php

namespace SOA\CodeSearchBundle\Services;

class KodersService {
    
    /**
     *
     * @param string $query
     * @return array 
     */
    public function search($query) {
        $results = array();
        $client = new \Zend_Http_Client('http://www.koders.com/default.aspx?s=SoapClient'.urlencode($query).'&la=*&li=*');
        $res = $client->request();
        $dom = new \DOMDocument();
        @$dom->loadHTML($res->getBody());
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//table[@id="__gResults"]/tr[not(@class="paginator")]/td');
        if(!empty($nodes)) foreach($nodes as $node)
            $results[] = str_replace('href="', 'href="http://www.koders.com', $node->C14N());
        return $results;
    }
    
}
