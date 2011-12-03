<?

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include('model.php');
include('view.php');
include('debugger.php');

/* 

- Annahme der URL des KEYWORDS und der VIEW
- Übergabe an MODEL NATIVE SCRAPER -> Seitem im Index, Position im Index
- Übergabe an VIEW und rendern des Outputs

*/


class controller {

    protected $Debugger;
    protected $DEBUG_MODE='dump';

    public function  __construct () {

      switch ($this->DEBUG_MODE) {
        case 'echo':
          $this->debugger = new DebuggerEcho();
          break;

        case 'dump':
          $this->debugger = new DebuggerVarDump();
          break;
      }

      $this->url = $_GET['url'];
      $this->keyword = $_GET['keyword']; 
//    $this->view = 'default';

      $googleScraper = new nativeScraper($this->keyword, $this->url);
      $this->result = $googleScraper->getResult();      
                  
    }


    public function makeView () {
    
      $makeWebView = new webView($this->result, $this->keyword, $this->url);
      echo $makeWebView->getOutput();
    
    }


    protected function debug ($msg) {
    
      $this->debugger->debug($msg);
    
    }

}


?>

