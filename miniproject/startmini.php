<?php


// add line test
require_once 'controllers/Maincontroller.php';

/**
 * get controllerClassname: 
 */
if (!isset($_GET['cc']) || $_GET['cc'] == "") {
    $sPosDirDelim = strrpos(FILE_CONST, '/');
    $fileName =  substr(FILE_CONST, ( $sPosDirDelim +1 ));
    $aFile = explode('.php', $fileName);
    $sClassname  = $aFile[0];
} else {
    $sClassname = $_GET['cc'];
}
/**
 * get controllerClass method name to call: 
 */
if (!isset($_GET['m']) || $_GET['m'] == "") {
    $sMethodName = 'index';
} else {
    $sMethodName = $_GET['m'];
}
$controllerClass = new Maincontroller($sClassname);
$controllerClass->getControllerClass()->$sMethodName();



