<?php

require_once 'controllers/Maintwocontroller.php';   // get Maincontroller
$mainObj = new Maintwocontroller(__FILE__);
$contObj = $mainObj->controllerObject;              // get controller object
$output = $contObj->{$mainObj->methodName}();       // Call
include('templates/' . $contObj->getTemplateName() . '.php'); // load html

      




