<?php
/**
 * Terawurfl
 * @package ZendTerawurfl
 * @subpackage Terawurfl_Controller_Action_Helper
 * @version 1.0
 * @author sabine steinkamp
 */
class Terawurfl_Controller_Action_Helper_Device extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * Useragent resource
     * @var object
     */
    protected $userAgent = null;
    
    /**
     * bootstrap 
     */
    public $bootstrap;
    
    public function __construct($bootstrap = "") {
        
        if ($bootstrap != "") {
            $this->bootstrap = $bootstrap;
        }
    }
    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action_Helper_Abstract::init()
     */
    public function init() {
        
        if ($this->userAgent === null) { // get userAgent object
            $this->bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
            $this->userAgent = $this->bootstrap->getResource('useragent');
        }
    }
    
    /**
     * 
     * Turn to global Device methods by injecting the userAgent object
     * 
     * @param string $sCalledMethod
     * @param array $params
     * <code>
     * $deviceOs = $this->_helper->getHelper('Device')->getDeviceOs();
     * </code>
     */
    public function __call($sCalledMethod, $params) {
        
        $oDeviceWrapper = new Terawurfl_Device($this->userAgent);
        return call_user_func_array(array($oDeviceWrapper, $sCalledMethod), $params);
    }
  
}

