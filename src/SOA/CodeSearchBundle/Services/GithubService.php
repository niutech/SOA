<?php

namespace SOA\CodeSearchBundle\Services;

class GithubService {
    
    /**
     *
     * @param string $query
     * @return array 
     */
    public function search($query) {
        $results = array();
        $client = new \Zend_Http_Client('https://github.com/search?q='.urlencode($query).'&repo=&langOverride=&start_value=1&type=Code');
        $res = $client->request();
        $dom = new \DOMDocument();
        @$dom->loadHTML($res->getBody());
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query("//div[@class='result']");
        if(!empty($nodes)) foreach($nodes as $node)
            $results[] = str_replace('href="', 'href="https://github.com', $node->C14N());
        return $results;
    }
    
}
