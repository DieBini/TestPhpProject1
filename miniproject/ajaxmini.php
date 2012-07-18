<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($_GET['name'])){
    $back = array("hello" => "Hallo ".$_GET['name'], "ip" => $_SERVER['REMOTE_ADDR'] );
    foreach ($_GET as $key => $value) {
        $back[$key] = $value;
    }
    #$ret = Array("hello" => "Hallo ".$_GET['name'], "ip" => $_SERVER['REMOTE_ADDR'] );
    sleep(2);
    echo json_encode($back);
}
 
