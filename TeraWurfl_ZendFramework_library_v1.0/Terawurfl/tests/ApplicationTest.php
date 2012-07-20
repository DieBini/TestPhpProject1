<?php

require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';
require_once 'Zend/Application.php';
require_once 'ControllerTestCase.php';
/**
 * 
 * Unit Tests Terawurfl
 * @author sabine steinkamp
 *
 */
class ApplicationTest extends ControllerTestCase {

    

    public function setUp() {
        parent::setUp();
    }

    public function  tearDown() {
        parent::tearDown();
    }
    
    public function test_ViewHelperInstance() {
        
        $helper = new Terawurfl_View_Helper_Device();
        $this->assertInstanceOf('Terawurfl_View_Helper_Device',$helper);
    }

    public function test_ControllerHelperdevice() {
        
        $helperDevice = Zend_Controller_Action_HelperBroker::hasHelper('device');
        $this->assertTrue($helperDevice);
    }
    
    /**
     * @covers Terawurfl_View_Helper_Device
     * @covers Terawurfl_View_Helper_Device::device
     * @covers Terawurfl_DeviceCore
     * @covers Terawurfl_Device
     */
    public function test_ViewHelperPath() {
        
        $bootstrap = $this->_application->getBootstrap();
        $view = $bootstrap->getResource('view');
        $helperPaths = $view->getHelperPaths();
        $this->assertArrayHasKey("Terawurfl_View_Helper_", $helperPaths);
    }
    /**
     * @covers Terawurfl_Controller_Action_Helper_Device
     * @covers Terawurfl_View_Helper_Device
     * @covers Terawurfl_View_Helper_Device::device
     * @covers Terawurfl_DeviceCore
     * @covers Terawurfl_Device
     */
    public function test_ControllerActionDevice() {
        
        $this->userAgent->setUserAgent("AOLMoviefone_iPhone/2.0.3.2 (iPhone; Version 3.1.3 (Build 7E18) )");
        $this->dispatch('unittest');
        $body = $this->getResponse()->getBody();
        print "BODY::". $body;
        $this->assertContains('UNITTEST CONTROLLER device_model_name: iPhone', $this->getResponse()->getBody());
    }
    /**
     * @covers Terawurfl_Controller_Action_Helper_Device
     * @covers Terawurfl_View_Helper_Device
     * @covers Terawurfl_View_Helper_Device::device
     * @covers Terawurfl_DeviceCore
     * @covers Terawurfl_Device
     */
    public function test_ControllerActionDeviceTwo() {
        
        $this->userAgent->setUserAgent('SAMSUNG-GT-I8320-Vodafone/I8320BUIJ8 Linux/X2/R1 Opera/9.6 ' 
            . 'SMS-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1');
        $request = $this->getRequest();
        $this->dispatch('unittest');
        $body = $this->getResponse()->getBody();
        $this->assertContains('UNITTEST VIEW device_model_name GT-I8320', $this->getResponse()->getBody());
        $this->assertContains('Device os: Linux Smartphone OS', $this->getResponse()->getBody()); 
    }
    
}

