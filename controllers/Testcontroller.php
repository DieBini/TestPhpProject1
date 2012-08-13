<?php
// @todo: implement autoloader
require_once 'controllers/Maincontroller.php';
require_once 'models/TestModel.php';
/**
 * Description of Testcontroller
 *
 * @author sabinesteinkamp
 */
class Testcontroller extends Maintwocontroller{



    public function __construct() 
    {  
    }
    
    
    
    public function indexRequest () 
    {
        $m = new TestModel();
        echo "hhhhhhh";
        $out = $m->getDataFromDb();
        $this->setTemplateName("loadform");
        return $out;
    }
    
    public function testRequest ()
    {
        $this->setTemplateName("loadform");
        return "Haaaahaaaa";
    }

    
    
}


