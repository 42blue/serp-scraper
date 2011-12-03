<?


interface Debugger {

  public function debug($msg);

}


class DebuggerEcho implements Debugger {

  public function debug($msg) {

    echo $msg . '<br/>';

  }

}


class DebuggerVarDump implements Debugger {

  public function debug($msg) {

    var_dump ($msg);
    echo '<br/>';

  }

}

?>

