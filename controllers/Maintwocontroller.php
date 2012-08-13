<?php
/**
 * Maincontroller
 *
 * @author sabinesteinkamp
 */

require_once 'models/MainModel.php'; // Simple Wrapper for Database Object

class Maintwocontroller {

    /**
     * Classname of controller
     * @var string 
     */
    protected $className = "";
    /**
     * Method Name
     * @var string 
     */
    public $methodName = "";
    /**
     * Filename of called file
     * @var string 
     */
    protected $calledByFile = '';
    /**
     * Controller Object
     * @var object 
     */
    public $controllerObject = '';
    
    /**
     * html template file to include
     * @var string 
     */
    public $templateName = '';


    /**
     * 
     * @param type $fileName 
     */
    public function __construct($fileName = "") 
    {
        $this->calledByFile = $fileName;
        $this->setRequestVars();
        $this->controllerObject = $this->getControllerObject();
        
    }

    /**
     * Get Classname and Method to call: 
     */
    public function setRequestVars() 
    {
        // get controllerClassname: 
        if (!isset($_GET['cc']) || $_GET['cc'] == "") {
            $this->className = $this->getFileName();
        } else {
            $this->className = $_GET['cc'];
        }
        // get method name to call: 
        if (!isset($_GET['m']) || $_GET['m'] == "") {
            $this->methodName = 'indexRequest';
        } else {
            $this->methodName = $_GET['m'] . 'Request';
        }
    }

    /**
     * Get Name of file
     * @return string 
     */
    public function getFileName() 
    {
        if (($this->calledByFile == "")) {
            return "index"; // default action method
        }
        $fileName = $this->calledByFile;
        $sPosDirDelim = strrpos($fileName, '/');
        $fileName = substr($fileName, ( $sPosDirDelim + 1));
        $file = explode('.php', $fileName);
        return $file[0];
    }

    /**
     * Get controller object
     * @return \controllerClass 
     */
    public function getControllerObject() 
    {
        $firstLetter = substr($this->className, 0, 1);
        $controllerClass = substr_replace($this->className, strtoupper($firstLetter), 0, 1) . 'controller';
        // @todo: implement Autoloader:
        require_once 'controllers/' . $controllerClass . '.php';
        return new $controllerClass();
    }

    /**
     * Get template name
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }
    
    /**
     *  Set template name
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

}

?>
