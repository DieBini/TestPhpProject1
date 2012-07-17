<?php

require_once 'controllers/Maincontroller.php';
/**
 * Description of Testcontroller
 *
 * @author sabinesteinkamp
 */
class Testcontroller extends Maincontroller{


    public function __call($name, $arguments) {
        echo $message =  __METHOD__ . ' - Called Method "'
            . $name . '" is not implemented in ' . get_called_class();
        throw new Exception($message);
    }
    
    public function index ($template ="") {
        
        $this->loadTemplate('test');
        $input = array('title' => $_GET['title'], 'name' => $_GET['name']);
        $this->assignVars($input);
        $this->render();
    }
    
    public function testtwo ($template ="") {
        $this->loadTemplate('testtwo');
        $input = array('title' => $_GET['title'], 'name' => $_GET['name']);
        $this->assignVars($input);
        $this->render();
    }
    
}


