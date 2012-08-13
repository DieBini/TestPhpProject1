<?php

require_once 'library/Db.php'; // Database

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainModel
 *
 * @author sabinesteinkamp
 */
class MainModel {
    
    /**
     * DB options
     * @var array 
     */
    protected $dbOptions = array();
    /**
     * DB object
     * @var object 
     */
    protected $dbObj = '';
    
    /**
     * 
     */
    public function __construct($dbObj="") 
    {
        if (isset($dbObj) && $dbObj !== '') {
           $this->dbObj = $dbObj; 
        } else {
           $this->dbObj = $this->getDatabase();
        }
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
