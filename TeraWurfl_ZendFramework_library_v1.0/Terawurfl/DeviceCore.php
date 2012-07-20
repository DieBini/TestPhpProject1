<?php
/**
 * Terawurfl
 *
 * @abstract
 * @package ZendTerawurfl
 * @subpackage Terawurfl_DeviceCore
 * @version 1.0
 * @author sabine steinkamp
 */
abstract class Terawurfl_DeviceCore {
    /**
     * 
     * User Agent
     * @var object
     */
    public $ua = null;
    /**
     * @var string
     */
    private $_name;
    /**
     * @var int
     */
    private $_width;

    /**
     * 
     * Construct by injecting userAgent object
     * @param object $oUserAgent
     */
    public function __construct($oUserAgent) {
        $this->ua = $oUserAgent;
    }

    /**
     * Get Feature
     * @param string $sFeatureName
     * @return mixed
     */
    public function getFeature($sFeatureName) {
        return $this->ua->getDevice()->getFeature($sFeatureName);
    }

    /**
     * 
     * Check if a feature exists
     * @param string $sFeatureName
     * @return bool 
     */
    public function getHasFeature($sFeatureName) {
        return $this->ua->getDevice()->hasFeature($sFeatureName);
    }

    /**
     * Get userAgent capability "device"
     * @return string 
     */
    public function getDeviceDevice() {
        return $this->ua->getDevice()->getFeature('device');
    }

    /**
     * Get userAgent capability "model_name"
     * @return string
     * 
     */
    public function getDeviceModelName() {
        return $this->ua->getDevice()->getFeature('model_name');
    }

    /**
     * Get userAgent capability "device_os"
     * @return string
     */
    public function getDeviceOs() {
        return $this->ua->getDevice()->getFeature('device_os');
    }

    /**
     * Get userAgent capability "getAllFeatures"
     * @return array
     */
    public function getDeviceAllFeatures() {
        return $this->ua->getDevice()->getAllFeatures();
    }

    /**
     * Get userAgent capability "getBrowserVersion"
     * @return string
     */
    public function getDeviceBrowserVersion() {
        return $this->ua->getDevice()->getBrowserVersion();
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
     * Get Id of device
     * @return string
     */
    public function getId() {
        return $this->getFeature('id');
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