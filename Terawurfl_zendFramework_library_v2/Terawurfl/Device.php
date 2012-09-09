<?php
/**
 * Terawurfl Device Wrapper
 *
 * overwrite existing methods for your needs or create new ones in here
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
    
    
    /**
     * Get name as combination of brand_name and model_name
     * @return string
     */
    public function getName() {
        
        if (null == $this->_name) {
            $name = array();
            if ($this->getHasFeature('brand_name')) {
                $name[] = $this->getFeature('brand_name');
            }
            if ($this->getHasFeature('model_name')) {
                $name[] = $this->getFeature('model_name');
            }
            $name = implode('-', $name);
            $name = str_replace(' ', '', $name);
            $this->_name = $name;
        }
        return $this->_name;
    }

    /**
     * Get width by mapping resolution_width to a group
     * @param Zend_Http_UserAgent_Device $device
     * @return int
     */
    public function getWidth() {
        
        if (null == $this->_width) {
            $width = $this->getFeature('resolution_width');
            if (240 >= $width) {
                $width = 240;
            } elseif (320 >= $width) {
                $width = 320;
            } elseif (360 >= $width) {
                $width = 360;
            } else {
                $width = 480;
            }
            $this->_width = $width;
        }
        return $this->_width;
    }
    
    /**
     * verify if device is an iphone
     * @return boolean
     */
    public function isIphone() {
        
        $device_os = $this->getFeature('device_os');
        return 'iphone os' == strtolower($device_os);
    }

}