
<?PHP 



function makeCurlRequest($requestURL) {    
    
      $url = 'http://www.scroogle.org/cgi-bin/nbbw.cgi?Gw=site:apple.com&l=de';    
    
      $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL,$url);    
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
      curl_setopt($ch, CURLOPT_PROXY, $requestURL);   
      curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION,3);       
      curl_setopt($ch, CURLOPT_TIMEOUT,2);
      return curl_exec($ch);     
}



function proxytester() {

      $proxies = array(
'72.93.200.139:80',
'64.90.59.115:80', 
'123.62.6.58:80', 
'67.158.49.67:80', 
'216.93.178.162:80', 
'64.151.72.28:80', 
'212.112.45.18:8080',      
'186.4.254.190:8080', 
'200.251.200.1:8080', 
'203.66.188.247:8080', 
'184.22.3.88:8080', 
'196.46.241.122:8080', 
'177.52.64.5:8080', 
'221.206.36.248:8080', 
'119.233.248.5:8080', 
'64.151.50.222:8080', 
'119.147.146.135:8080', 
'88.247.213.224:8080', 
'58.254.134.201:8080', 
'122.226.50.66:8080', 
'119.6.105.45:8080', 
'64.90.59.115:80',        
'220.229.238.115:8080',
'217.198.37.50:8080',
'212.28.231.253:8080',
'186.4.254.190:8080',
'200.251.200.1:8080',
'203.66.188.247:8080',
'218.92.252.39:8080',
'193.194.85.94:8080',
'216.49.106.41:8080',
'212.112.45.18:8080',
'184.22.3.88:8080',
'163.26.71.123:8080',
'219.246.76.50:8080',
'196.46.241.122:8080',
'218.92.29.29:8080',
'90.157.61.135:8080',
'177.52.64.5:8080',
'221.206.36.248:8080',
'148.228.20.113:8080',
'219.7.224.44:8080',
'119.233.248.5:8080',
'64.151.50.222:8080',
'67.202.108.170:8080',
'212.118.23.98:8080',
'210.201.213.61:8080',
'190.167.212.203:8080',
'119.147.146.135:8080',
'220.113.15.21:8080',
'88.247.213.224:8080',
'218.92.252.37:8080',
'188.40.37.197:8080',
'78.188.185.173:8080',
'58.254.134.201:8080',
'122.226.50.66:8080',
'117.141.59.155:8080',
'119.6.105.45:8080',
'64.132.153.78:8080',
'200.52.196.123:8080',
'218.104.38.109:8080',
'220.130.10.209:8080',      
        "204.210.141.114:8085",
        "184.154.188.122:8118",
        "64.90.59.115:80"       
      );


   foreach ($proxies as $element) {   

     $show = makeCurlRequest($element);
     
     if ($show == NULL) {
     
       // echo $element . " DEAD <br />";
     
     } else {
     
       echo "'".$element. "', <br />";     
       
     }
     
     // var_dump ($show);
      
   }


}

proxytester();

?>

