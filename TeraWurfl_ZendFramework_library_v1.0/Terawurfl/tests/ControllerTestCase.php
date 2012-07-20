<?php
require_once 'Zend/Application.php';
require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';

/**
 * 
 * Unit Tests Terawurfl
 * @author sabine steinkamp
 *
 */
class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     *
     * @var Zend_Application
     */
    protected $_application;
    /**
     * Useragent resource
     * 
     */
    protected $userAgent = null;
    
    
    public function setUp() {
        
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
        if($this->getFrontController()->getParam('bootstrap') === null) {
            $this->getFrontController()->setParam('bootstrap', $this->_application->getBootstrap());
        }
        $testControllerDir = realpath(dirname(__FILE__) . '/application/testing/controllers');
        $this->getFrontController()->setControllerDirectory($testControllerDir);  
        $bootstrap = $this->_application->getBootstrap();
        $this->userAgent = $bootstrap->getResource('useragent');
    }
    
    public function appBootstrap() {
        
       $this->_application = new Zend_Application(
           APPLICATION_ENV,
           realpath(dirname(__FILE__) . '/application/configs/application.ini'));
       $this->_application->bootstrap();  
       // even if you do not use layout, unit test need this:
       Zend_Controller_Action_HelperBroker::addHelper(new Zend_Layout_Controller_Action_Helper_Layout);
    }
    
    public function  tearDown() {
        
        $this->resetRequest();
        $this->resetResponse();
        $this->reset();
        parent::tearDown();
    }
}






