<?php

namespace SOA\CodeSearchBundle\Services;

class GithubService extends BackendService {
    
    /**
     *
     * @param string $query
     * @return SOA\CodeSearchBundle\Services\ResultSet
     */
    public function search($query) {
        $results = new ResultSet($query);
        $arr = array(); //of Result
        $client = new \Zend_Http_Client('https://github.com/search?q='.urlencode($query).'&repo=&langOverride=&start_value=1&type=Code');
        $res = $client->request();
        $dom = new \DOMDocument();
        @$dom->loadHTML($res->getBody());
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query("//div[@class='result']");
        if(!empty($nodes)) foreach($nodes as $node) {
            $a = $xpath->query("h2/a", $node);
            $c = $xpath->query("div/pre", $node);
            $result = new Result();
            $result->title = $a->item(0)->nodeValue;
            $result->url = 'https://github.com'.$a->item(0)->getAttribute('href');
            $result->code = $c->item(0)->C14N();
            $arr[] = $result;
        }
        $results->results = $arr;
        return $results;
    }
    
}
