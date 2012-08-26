<?php
/**
 * Terawurfl
 * @package ZendTerawurfl
 * @subpackage Terawurfl_Application_Resource
 * @version 1.0
 * @author sabine steinkamp
 */
class Terawurfl_Application_Resource_Loader extends Zend_Application_Resource_ResourceAbstract
{

    const DEFAULT_REGISTRY_KEY = 'loader';
    
    public function init() {
        
        $options = $this->getOptions();
        
        // setting for using controller action helper is on:
        if (isset($options['useactionhelper']) && $options['useactionhelper'] == "on") {
            $this->registerControllerHelper();
        }
        // setting for use CacheManager for storage is on, check if object is there:
        if (isset($options["usecachemanager"]) 
            && $options["usecachemanager"] == "yes") {  
           $this->checkCachemanager();
        }
        // setting for using controller action helper is on:
        if (isset($options['checkviewhelper']) && $options['checkviewhelper'] == "on") {
            $this->checkConfigurations();
        }
    }
    
    /**
     * Check if Cachemanager resource is set up
     * Throw exception in case it is not and resources.loader.usecachemanager = "yes"
     */
    protected function checkCachemanager() {
        
        $bootstrap = $this->getBootstrap();
        $cachemanager = $bootstrap->getPluginResource('cachemanager');
        if (!is_object($cachemanager)) {
            throw new Terawurfl_Exception(__METHOD__ . ' - ' . " - No Resource Cachemanager was set up! ", 0);
        }
    }
        
    /**
     * Register Controller Action Helper "device"
     * Note that existing "Device" View Helper are going to be unset and TW one will be added!
     * <code>
     * // call helper in Controller :
     * $device = $this->_helper->getHelper('Device');
     * </code>
     */   
    protected function registerControllerHelper() {
        Zend_Controller_Action_HelperBroker::addPath(realpath(APPLICATION_PATH . 
        	'/../library/Terawurfl/Controller/Action/Helper'),'Terawurfl_Controller_Action_Helper_');
        if (Zend_Controller_Action_HelperBroker::hasHelper('device') === false) {
            Zend_Controller_Action_HelperBroker::addHelper(  new Terawurfl_Controller_Action_Helper_Device());
        } else {
            // overwrite existing View Helper with terawurfl one, so first remove then add:
            Zend_Controller_Action_HelperBroker::removeHelper('device');
            Zend_Controller_Action_HelperBroker::addHelper(  new Terawurfl_Controller_Action_Helper_Device());
        } 
    } 
    
    /**
     * Check configurations, if mandatory Device Helper already registered somewhere else
     * Throw Exception in case it is because terawurfl library excpects to use the Terawurfl one
     * 
     */
    protected function checkConfigurations() {
       
        // get HelperPaths:
        $bootstrap = $this->getBootstrap();
        $view = $bootstrap->getResource("view");
        $helperPaths = $view->getHelperPaths();
  
        // Check View Helper set up
        if (isset($helperPaths) && (count($helperPaths) > 1)) {
            // check if there already is a Helper "Device" set:
            foreach ($helperPaths as $key => $value) {
                $deviceHelperName = $key . "Device";
                if ($deviceHelperName != "Terawurfl_View_Helper_Device") {
                    if (@class_exists($deviceHelperName)) {
                        throw new Terawurfl_Exception(__METHOD__ . ' - ' 
                            . "Device Helper called $deviceHelperName already exists. "
                            . "Please use Terawurfl_View_Helper_Device ", 0);
                    }
                }
            }
        }
    }
}