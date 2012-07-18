<?php
#require_once 'library/TemplateSimple.php';
#require_once 'library/Template.php';
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
        
    /**
     * template Engine
     * @param type $class 
     */
    public $templateEngine ="TemplateSimple";
    
    
    public function __construct ($class) {
        $this->className = $class;
    }
    
    public function getControllerClass() {
        
        $firstLetter = substr($this->className,0,1);
        $controllerClass = substr_replace($this->className, strtoupper($firstLetter), 0, 1) . 'controller' ;
        require_once 'controllers/'. $controllerClass .'.php';
        return new $controllerClass();
        
    }
    
    public function setTemplateEngine($templateEngine="") {
        try {
            $this->templateEngine = $templateEngine;
            require_once 'library/'.$templateEngine.'.php';
        
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function getTemplateEngine() {
        return $this->templateEngine;
    }
    
    public function loadTemplate($templateFile) {
        try {
            require_once 'library/TemplateSimple.php';
            $templateEngine = $this->templateEngine;
            $this->tpl = new $templateEngine(); 
            $this->tpl->load("$templateFile.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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
