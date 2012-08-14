<?php

require_once 'controllers/Maincontroller.php';   // get Maincontroller
$mainObj = new Maincontroller(__FILE__);
$contObj = $mainObj->controllerObject;              // get controller object
$output = $contObj->{$mainObj->methodName}();       // Call
include('templates/' . $contObj->getTemplateName() . '.php'); // load html

      




