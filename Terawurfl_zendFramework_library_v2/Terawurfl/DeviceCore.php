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
     * Get Id of device
     * @return string
     */
    public function getId() {
        return $this->getFeature('id');
    }

    
}