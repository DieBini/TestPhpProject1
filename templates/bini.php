<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?><!DOCTYPE html>  
    <html lang="de">  
      <head>  
        <meta charset="utf-8">  
        <!-- jQuery wird eingebunden -->  
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script> -->
        <script src="http://code.jquery.com/jquery-1.7.2.js"></script>
        
       
        <script src="http://nb.einsclone.lo/templates/biniajax.js"></script>
        
        
<style type="text/css">
<!--          
body{
        text-align:left;
}
 
.loading_icon {
	float:left;
	background:url(ajax-loader.gif) no-repeat 1px;
	height:30px;
	width:30px;
	display:none;
}
.done {
	background:url(iconIdea.gif) no-repeat 2px;
	padding-left:20px;
	font-size:12px;
	width:70%;
	margin:20px auto;
	display:none
}
 
.clear {clear:both}
 
.block {
	width:400px;
	margin:0 auto;
	text-align:left;
}
.input * {
    
	padding:5px;
	margin:2px;
	font-size:12px;
}
.input label {
	float:left;
	width:75px;
	font-weight:700
}
.input input.text {
	float:left;
	width:270px;
	padding-left:20px;
}
.input .textarea {
	height:120px;
	width:270px;
	padding-left:20px;
}
 
.input #submit {
	float:left;
	margin-right:10px;
}
-->
        </style> 
           
      </head>  
      <body>  
      
          
          
            <div class="block">
            <div class="done">
            <b>Vielen Dank. Wir haben Ihre Anfrage erhalten</b>
            </div>
                    <div class="myForm">
                    <form method="post" action="#">
                    <div class="input">
                            <label>Name</label>
                            <input type="text" name="name" class="text" />
                    </div>
                    <div class="input">
                            <label>Email</label>
                            <input type="text" name="email" class="text" />
                    </div>
                    <div class="input">
                            <label>Kommentar</label>
                            <textarea name="kommentar" class="text textarea" /></textarea>
                    </div>
                    <div class="input">
                        <input type="submit" id="submit"/>
                        <div class="loading_icon"></div>
                    </div>
                    </form>
                    </div>
            </div>
            <div class="clear"></div>


      </body>  
    </html>

