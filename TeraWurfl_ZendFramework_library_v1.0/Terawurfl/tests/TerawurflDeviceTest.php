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
class TerawurflDeviceTest extends ControllerTestCase {

    
    /**
     * Prepares the environment before running a test.
     */
    public function setUp() {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    public function tearDown() {
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct() {
        // TODO Auto-generated constructor
    }
    
	/**
     * @covers Terawurfl_Device_Core::getDeviceModelName
     * @covers Terawurfl_Device_Core::getDeviceOs
     * @covers Terawurfl_Device_Core::getName
     * @covers Terawurfl_Device_Core::getName
     * @covers Terawurfl_Device_Core::getId
     * @covers Terawurfl_Device_Core::getFeature
     * @covers Terawurfl_Device_Core::getWidth
     */
    public function test_allDeviceMethods() {
        
        $this->userAgent->setUserAgent("AOLMoviefone_iPhone/2.0.3.2 (iPhone; Version 3.1.3 (Build 7E18) )");
        $device = new Terawurfl_Device($this->userAgent);
        $aTestMethodsAndResults = array(
            "getDeviceModelName" => array("res" => "iPhone"),
            "getDeviceOs" => array("res" => "iPhone OS"),
            "getName" => array("res" => "Apple-iPhone"),
        	"getFeature" => array("res" => "320","params" => "resolution_width"),
            "getHasFeature" => array("res" => 'true',"params" => "resolution_width"),
            "getWidth" => array("res" => '320'), 
        );
        
        foreach ($aTestMethodsAndResults as $method => $inputOutput) {
            if (isset($inputOutput['params']) && is_array(isset($inputOutput['params'])) 
            && count($inputOutput['params']) > 0 ){
                  
                $result = $device->$method(implode(",", $inputOutput['params']));
            }
            elseif (isset($inputOutput['params'])) {
                $result = $device->$method($inputOutput['params']);
            } else {    
                $result = $device->$method();
            }
            $this->assertEquals($inputOutput['res'], $result);
        }
    }
    
	/**
     * @covers Terawurfl_Device_Core::getDeviceAllFeatures
     */
    public function test_DeviceMethodAllFeatures() {
        
        $this->userAgent->setUserAgent("AOLMoviefone_iPhone/2.0.3.2 (iPhone; Version 3.1.3 (Build 7E18) )");
        $device = new Terawurfl_Device($this->userAgent);
        $result = $device->getDeviceAllFeatures();
        $this->assertArrayHasKey("browser_name", $result);
        $this->assertArrayHasKey("is_mobile", $result);
        $this->assertArrayHasKey("device", $result);
        $this->assertEquals("iphone", $result['device']);
        $this->assertEquals(true, $result['is_mobile']);
    }
}

