<?php

#require_once 'controllers/Testcontroller.php';
/**
 * Description of Maincontroller
 *
 * @author sabinesteinkamp
 */
class Maincontroller{

    /**
     * Classname of controller
     * @var string 
     */
    public $className = "";
    /**
     * Template class
     * @var object 
     */
    public $tpl = "";
        
    public function __construct ($class) {
        $this->className = $class;
    }
    
    public function getControllerClass() {
        
        $firstLetter = substr($this->className,0,1);
        $controllerClass = substr_replace($this->className, strtoupper($firstLetter), 0, 1) . 'controller' ;
        require_once 'controllers/'. $controllerClass .'.php';
        #$t = new $controllerClass();
        #var_dump($t);
        #die;
        return new $controllerClass();
        
    }
    
    public function loadTemplate($templateFile ="") {
        require_once 'library/TemplateSimple.php';
        $this->tpl = new TemplateSimple(); 
        $this->tpl->load("$templateFile.php"); 
        #$this->tpl->assign("title", "der text..."); 
        #$this->tpl->out(); 
    }
    
    public function assignVars($vars = array()) {
        foreach ($vars as $key => $value) {
            $this->tpl->assign($key, $value); 
        }
        
    }
    
    public function render() {
        $this->tpl->out(); 
    }
    
}

?>
