<?php

$strDbLocation = 'mysql:dbname=playground;host=localhost';
$strDbUser = 'bp';
$strDbPassword = '';
try {

  $objDb = new PDO($strDbLocation, $strDbUser, $strDbPassword);

} catch (PDOException $e) {
  echo 'Datenbank-Fehler: ' . $e->getMessage();
 die;
}

#echo "222";
/*
 * $test = "CREATE TABLE `comment` (

  `id` bigint(20) unsigned NOT NULL auto_increment,

  `message` text NOT NULL,

  `email` text NOT NULL,PRIMARY KEY  (`id`)

)";
 */

try {

 # $intResult = $objDb->exec("INSERT INTO comment (message, email) VALUES ('Hallo Welt', 'ich@xy.de')");
 # echo $intResult;
  $dbResult = $objDb->query("SELECT * FROM comment");
  foreach($dbResult as $row)

{

  echo $row[0]." ".$row[1]."<br/>\n";

}

} catch (PDOException $e) {
  echo 'Datenbank-Fehler: ' . $e->getMessage();
 die;
}



################
  try
  {
    //create the database.
    //this will generate the database file in the directory in which this script exists.
    //If this file already exists, the database will be opened on this file.
    $database = new SQLiteDatabase('CatsDb.sqlite', 0666, $error);
  }
  catch(Exception $e)
  {
    die($error);
  }

  //Add a new table to the database called Cats
  #$query = 'CREATE TABLE Cats (Id INTEGER, Breed TEXT, Name TEXT, Age INTEGER)';
  #if(!$database->queryExec($query, $error))
  #{
  #  die($error);
  #}

  //Insert several Dog records&nbsp; into the Dog table
  $query = "INSERT INTO Cats (Id, Breed, Name, Age) VALUES (1, 'Labrador', 'Tank', 2); " .
           "INSERT INTO Cats (Id, Breed, Name, Age) VALUES (2, 'Husky', 'Glacier', 7); " .
           "INSERT INTO Cats (Id, Breed, Name, Age) VALUES (3, 'Golden-Doodle', 'Ellie', 4)";
  if(!$database->queryExec($query, $error))
  {
    die($error);
  }

  //Read all of the data from the Cats table and print it in an HTML table
  $query = "SELECT * FROM Cats";
  if($result = $database->query($query, SQLITE_BOTH, $error))
  {
    print "<table border=1>";
    print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
    while($row = $result->fetch())
    {
      print "<tr><td>{$row['Id']}</td><td>{$row['Breed']}</td><td>{$row['Name']}</td><td>{$row['Age']}</td></tr>";
    }
    print "</table>";
  }
  else
  {
    die($error);
  }



/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
