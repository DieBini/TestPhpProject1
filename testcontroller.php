<?php

// test änderung zum git lernen
require_once 'library/Template.php';

$controller = new testcontroller();



#$controller->test();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author sabinesteinkamp
 */
class testcontroller {
    //put your code here
    
   public function __construct () {
        $method = $_GET['m'];
        $this->$method();  
    }
    
    public function test () {

        // Ordner beim alten belassen und nur eine neue Instanz erzeugen:
        $tpl = new Template(); 
        $tpl->load("test.php"); 
        $tpl->assign("title", "der text..."); 
        $tpl->out();
    }
    
    
}

?>
