<?

class webView {

    protected static $iconGood = '<img src="http://42blue.de/onpage-seo-check/util/good.png" alt="Good" />';
    protected static $iconWarning = '<img src="http://42blue.de/onpage-seo-check/util/warning.png" alt="Warning" />';
    protected static $iconError = '<img src="http://42blue.de/onpage-seo-check/util/error.png" alt="error" />';   


    public function  __construct ($result, $keyword, $url) {
    
    /* Anzahl der Seiten im Index */
      $this->sitesInIndex = $result['number'];
      
    /* Anzahl der URLs in den Top 100 für das Keyword */ 
      $this->urlsInIndex = $result['position'];     
      
      $this->url = $url;
      $this->keyword = $keyword;      
          
    }


    public function getOutput() {     

      $this->createHtmlSitesInIndex(); 
      $this->createHtmlURLsforKeyword();       
      $this->HtmlBuildTable();  

      return $this->webHtml;     
      
    }


    protected function createHtmlSitesInIndex() {
    
 	  if ($this->sitesInIndex <= '3')  {
 	  
   	    $this->HtmlSitesInIndex = $this->url .' hat keine Seiten im Google Index';
        $this->HtmlSitesInIndexIcon = self::$iconError; 
 	  
 	  } elseif ($this->sitesInIndex <= '25') {
 	  
   	    $this->HtmlSitesInIndex = $this->url .' hat '. $this->sitesInIndex . ' Seiten im Google Index'; 	  
        $this->HtmlSitesInIndexIcon .= self::$iconError;  
 	  
 	  } elseif  ($this->sitesInIndex > '25' and $this->sitesInIndex < '75') {

   	    $this->HtmlSitesInIndex = $this->url .' hat '. $this->sitesInIndex . ' Seiten im Google Index';  	  
        $this->HtmlSitesInIndexIcon .= self::$iconWarning; 

 	  } elseif  ($this->sitesInIndex >= '75' and $this->sitesInIndex < '100') {

   	    $this->HtmlSitesInIndex = $this->url .' hat '. $this->sitesInIndex . ' Seiten im Google Index';  	  
        $this->HtmlSitesInIndexIcon .= self::$iconGood; 

 	  } elseif  ($this->sitesInIndex >= '100') {

   	    $this->HtmlSitesInIndex = $this->url . ' hat über 100 Seiten im Google Index';  	  
        $this->HtmlSitesInIndexIcon .= self::$iconGood; 
        
 	  }

    }


    protected function createHtmlURLsforKeyword() {

 	  if (empty($this->urlsInIndex)) {

        $this->HtmlURLsforKeyword = 'Auf den ersten 10 Google Suchergebnisseiten wurde die Domain <b>'. $this->url .'</b> für das Keyword <b>'. $this->keyword .'</b> nicht gefunden.';
        $this->HtmlURLsforKeywordIcon = self::$iconError;
  
      } else {

        $this->HtmlURLsforKeyword = 'Die Domain <b>'. $this->url .'</b> wurde für das Keyword <b>'. $this->keyword .'</b> auf<br />folgenden Positionen gefunden: <b>';

          $first = true;

		  foreach ($this->urlsInIndex as $value) {
		    
		    if (!$first) {
		      $this->HtmlURLsforKeyword .=  ', ';  
		    } else {
    		  $first = false;    		    
		    }
		    
		    $this->HtmlURLsforKeyword .=  $value;
		    	    		    
		  }
		  
        $this->HtmlURLsforKeyword .= '</b>';
        $this->HtmlURLsforKeywordIcon .= self::$iconGood;    
        
      }
 	  
    }


    protected function HtmlBuildTable() {

      ob_start();
      
		echo '<table>'; 
		echo   '<tr>'; 
		echo     '<th>Check</th>'; 
		echo     '<th>Resultat</th>'; 
		echo     '<th class="third">#</th>';  
		echo   '</tr>'; 
		echo   '<tr>'; 
		echo     '<td class="first" rowspan="2">Google</td>'; 
		echo     '<td class="second">'; 
		echo        $this->HtmlURLsforKeyword . '<br />'; 
		echo        '<small><a href="http://www.google.de/search?q='.$this->keyword.'&num=100" rel="external">Link zo Google</a></small>';  	    
		echo     '</td>';  	    
		echo     '<td class="third">' .$this->HtmlURLsforKeywordIcon. '</td>';  
		echo   '</tr>';             
		echo   '<tr>'; 
		echo      '<td class="second">'; 
		echo        $this->HtmlSitesInIndex . '<br />'; 	    
		echo        '<small><a href="http://www.google.de/search?q=site:'.$this->url.'&num=100" rel="external">Link zo Google</a></small>';  	    
		echo     '</td>';  	    
		echo     '<td class="third">' .$this->HtmlSitesInIndexIcon. '</td>';  
		echo   '</tr>';             
		echo '</table>';
		
      $this->webHtml = ob_get_contents();
      ob_end_clean();
      
    }

}

?>

