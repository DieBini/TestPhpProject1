<?php
/**
 * Maincontroller
 *
 * @author sabinesteinkamp
 */

require_once 'library/Db.php'; // Database

/**
 *  
 */
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
     * DB options
     * @var array 
     */
    protected $dbOptions = array();
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
            return "index";
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
     * Get database
     * @param array $options
     * @return object \Db 
     */
    public function getDatabase() 
    {
        return new Db($this->dbOptions);
    }
    
    /**
     * set db options to be able to inject different dbs
     * @param array $options
     */
    public function setDatabaseOptions($options) 
    {
        $this->dbOptions = $options;
    }

}

?>
