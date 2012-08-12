<?php
/**
 * Description of Db
 *
 * @author sabinesteinkamp
 */
class Db extends PDO { 

    private $engine = 'mysql';
    private $host = '';
    private $database = '';
    private $user = '';
    private $pass = '';
    private $iniFile = 'DBSettings.ini';
   
    public function __construct($options=array()){
        
        if(empty($options)) {
            // use specila iniFile?
            if(isset($options['iniFile'])) $this->iniFile = $options['iniFile'];
            // pasre ini file:
            if (!$options = parse_ini_file(realpath(dirname(__FILE__)) . '/' .$this->iniFile)) 
                throw new exception('Unable to open ' . $this->iniFile . '.');
        }
        
        if(isset($options['engine'])) $this->engine = $options['engine'];
        if(isset($options['host'])) $this->host = $options['host'];
        if(isset($options['schema'])) $this->schema = $options['schema'];
        if(isset($options['user'])) $this->user = $options['user'];
        if(isset($options['pass'])) $this->pass = $options['pass'];
        
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        return parent::__construct( $dns, $this->user, $this->pass );
    }
}
?>
