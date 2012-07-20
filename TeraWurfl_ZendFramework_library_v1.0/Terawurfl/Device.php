<?php
/**
 * Terawurfl Device Wrapper
 *
 * overwrite existing methods or create new ones in here
 *
 * @package ZendTerawurfl
 * @subpackage Terawurfl_Device
 * @version 1.0
 * @author sabine steinkamp
 */
class Terawurfl_Device extends Terawurfl_DeviceCore 
{
    
    /**
     * Construct by injecting UserAgent object
     * @param object $oUserAgent
     */
    public function __construct($oUserAgent) {
        parent::__construct($oUserAgent);

    }

}