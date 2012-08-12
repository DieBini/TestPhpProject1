<?php
// add line test
require_once 'controllers/Maintwocontroller.php';

$mainObj = new Maintwocontroller(__FILE__);
$output = $mainObj->controllerObject->{$mainObj->methodName}();

print_r($output);
     