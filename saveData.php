<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$text = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
 
    //do some data saving stuff
    $allGood = saveMethod($text,$email,$comment);
 
    if($allGood){
        echo 1;
    }else{
        echo 2;
    }
 
function saveMethod($text,$email,$comment){
  //do some DB queries
  return true;
}
