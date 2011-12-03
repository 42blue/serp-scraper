<?

// http://seorch.de/new/checker-google/index.php?url=getmad.de&keyword=matthias

// $this->debug();

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include('controller.php');

$controller = new controller();  
$controller->makeView();   


?>

