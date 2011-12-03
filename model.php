<?

class nativeScraper {

    protected $Debugger;
    protected $DEBUG_MODE='echo';
    protected static $scroogle = 'http://www.scroogle.org/cgi-bin/nbbw.cgi?Gw='; 
    //protected static $scroogle = 'http://www.google.de'; 
    protected $positionUrl = array ();
    protected $result = array ();    
    protected $keyword;
    protected $url;
    protected $requestKeyword;    
    protected $requestUrl;   
    protected $countPdfsInIndex;
    protected $countSitesInIndex;    

   
    public function  __construct ($keyword, $url) {

      switch ($this->DEBUG_MODE) {
        case 'echo':
          $this->debugger = new DebuggerEcho();
          break;

        case 'dump':
          $this->debugger = new DebuggerVarDump();
          break;
      }
    
      $this->url = $url;
      $this->keyword = $keyword; 
      $this->searchUrlsInIndex(); 
      $this->searchKeywordUrlPosition();   
      
    }


    public function getResult() {     
    
      return $this->result;     
      
    }


    public function getRandomUserAgent() {     
    
      $userAgents = array(
        "Mozilla/5.0 (X11; U; Linux i586; en-US; rv:1.7.3) Gecko/20040924 Epiphany/1.4.4 (Ubuntu)", 
        "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1", 
        "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1", 
        "Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52",
        "Mozilla/5.0 (Mozilla/5.0 (Linux; U; Android 2.3; en-us) AppleWebKit/999+ (KHTML, like Gecko) Safari/999.9",
        "Mozilla/5.0 (Windows; U; MSIE 9.0; WIndows NT 9.0; en-US))",
        "Mozilla/5.0 (Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.54 Safari/535.2",
        "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.861.0 Safari/535.2",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.861.0 Safari/535.2",
        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; Zune 3.0)",
        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; msn OptimizedIE8;ZHCN)",
        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; MS-RTC LM 8; InfoPath.3; .NET4.0C; .NET4.0E) chromeframe/8.0.552.224",
        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; MS-RTC LM 8; .NET4.0C; .NET4.0E; Zune 4.7; InfoPath.3)",
        "Opera/9.80 (X11; Linux x86_64; U; Ubuntu/10.10 (maverick); pl) Presto/2.7.62 Version/11.01",
        "Opera/9.80 (X11; Linux i686; U; ja) Presto/2.7.62 Version/11.01",
        "Opera/9.80 (X11; Linux i686; U; fr) Presto/2.7.62 Version/11.01",
        "Opera/9.80 (Windows NT 6.1; U; zh-tw) Presto/2.7.62 Version/11.01",
        "Opera/9.80 (Windows NT 6.1; U; zh-cn) Presto/2.7.62 Version/11.01",
        "Opera/9.80 (Windows NT 6.1; U; sv) Presto/2.7.62 Version/11.01"        
      );
   
     return $randomUserAgent = $userAgents[array_rand($userAgents, 1)];
     
    }


    public function getRandomProxy() {     
    
    //'72.93.200.139:80', '119.147.146.135:8080','212.28.231.253:8080',   64.90.59.115:80, 123.62.6.58:80, 67.158.49.67:80, 216.93.178.162:80, 64.151.72.28:80, 212.112.45.18:8080
    
      $proxies = array(
'72.93.200.139:80', 
'64.151.72.28:80', 
'64.90.59.115:80'
      );
   
     return $randomProxy = $proxies[array_rand($proxies, 1)];
     
    }


    protected function makeCurlRequest($requestURL) {    
    
      $useragent = $this->getRandomUserAgent();
      $proxy = $this->getRandomProxy();      


$this->debug($useragent);
$this->debug($proxy);
      
      $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL,$requestURL);    
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
      curl_setopt($ch, CURLOPT_PROXY, $proxy);
//      curl_setopt ($ch, CURLOPT_REFERER, "http://www.somewhere.com/");       
      curl_setopt($ch, CURLOPT_USERAGENT, $useragent); 
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION,3);       
      curl_setopt($ch, CURLOPT_TIMEOUT,6);

      return curl_exec($ch);     
      
    }


    protected function hasHTTP($url) {    
    
      if (strpos($url, 'http://')!==false or strpos($url, 'https://')!==false) {
      
        return $url;
        
      } else {
      
        return 'http://'.$url;
        
      }  
      
    }


    protected function hasWWW($url) {    
    
      $url = parse_url($url);
      
      $url = $url['host'];
      
      return str_replace('www.', '', $url);
      
    }
    

    protected function getGoogleSERP($response) {   

      $dom = new DOMDocument('1.0');
      
      @$dom->loadHTML($response);
      
      return $dom->getElementsByTagName('a');
  
    }      
      
    
    protected function searchUrlsInIndex() {  

      $this->url = $this->hasHTTP($this->url);

      $this->url = $this->hasWWW($this->url);

      $this->requestUrl = self::$scroogle .'site:'. $this->url .'&l=de'; 

      $response = $this->makeCurlRequest($this->requestUrl);    

      $anchors = $this->getGoogleSERP($response);

        foreach ($anchors as $element) {

          $href = $element->getAttribute('href');

          $pos = stripos($href, '.pdf');

          if ($pos !== false) {

            $this->countPdfsInIndex++;          

		  } else {

            $this->countSitesInIndex++;          		  

		  }         		  

        }      
      
      $this->result['number'] = $this->countSitesInIndex; 
      
    }


    protected function searchKeywordUrlPosition() {  

      $this->keyword = str_replace(' ', '+', $this->keyword);
      
      $this->requestKeyword = self::$scroogle . $this->keyword .'&l=de';        

      $response = $this->makeCurlRequest($this->requestKeyword);  
      
      $anchors = $this->getGoogleSERP($response);

        foreach ($anchors as $element) {
        
          $href = $element->getAttribute('href');
          
          $pos = stripos($href, $this->url);
          
          $this->position++; 
          
          if ($pos !== false) {
          
		    array_push($this->positionUrl, $this->position);
		    
		  }
		  
        }      

      $this->result['position'] = $this->positionUrl; 

    }


    protected function debug ($msg) {
    
      $this->debugger->debug($msg);
    
    }

}

?>

