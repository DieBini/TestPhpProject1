<?php
/**
 * Terawurfl
 *
 * @package ZendTerawurfl
 * @subpackage Terawurfl_View_Helper
 * @version 1.0
 * @author sabine steinkamp
 */
class Terawurfl_View_Helper_Device extends Zend_View_Helper_Abstract
{

    /**
     * View device helper method, get global DeviceWrapper
     */
    public function device() {
        $userAgent = $this->view->userAgent();
        $oDevice = new Terawurfl_Device($userAgent);
        return $oDevice;
    }
    
}