<!DOCTYPE html>  
<html lang="de">  
    <head>  
        <meta charset="utf-8">  
        <!-- jQuery  -->  
        <script src="http://code.jquery.com/jquery-1.7.2.js"></script>
        <style type="text/css">
            <!--          
            body{
                text-align:center;
            }



            .clear {clear:both}

            .block {
                width:800px;
                margin:0 auto;
                text-align:left;
            }
            .lin {
                text-decoration-color: black;
            }
            .myForm * {
                float: left;
                padding:5px;
            }
            .input * {

                padding:5px;
                margin:2px;
                font-size:12px;
            }
            .input label {

                width:575px;
                font-weight:700
            }
            .input input.text {

                width:570px;
                padding-left:20px;
            }


            .input #submit {
                background-color: #009999;
                margin-right:10px;
            }
            -->
        </style> 

    </head>  
    <body>  

        <?php
     
        #print_r( $output,true);
        var_dump($output);
        
        if (count($aList) == 0) {
            echo '<a href="load.php" class="lin">LOAD DATA</a>';
        } else {
            echo '<a href="load.php" class="lin">RELAOD DATA</a>';
        }
        ?>

        <div class="block">
            <?php 
            foreach ($aList as $key => $data) {
                ?>

                <div class="myForm">
                    <form method="post" action="saveData.php">
                        <input type="hidden" name="id" value="<?php echo $aList[$key]['ID']; ?>">

                        <?php
                        foreach ($aList[$key] as $dbKey => $dbValue) {

                            if (!is_int($dbKey) && $dbKey != "id" && $dbKey != "Datetime") {
                                ?>
                                <div class="input">
                                    <label><?php echo $dbKey; ?></label>
                                    <input type="text" name="<?php echo $dbKey; ?>" class="text" value="<?php echo $dbValue; ?>" />
                                </div>                            

                                <?php
                            }
                        }
                        ?>
                        <div class="input">
                            <input type="submit" id="submit" value="save changes"/>
                            <div class="loading_icon"></div>
                        </div>

                    </form>
                </div>
          

    <?php
}
?>
 
        </div>
        <div class="clear"></div>


    </body>  
</html>
