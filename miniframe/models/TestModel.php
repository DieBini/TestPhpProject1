<?php
// @todo: implement autoloader
require_once 'models/MainModel.php'; // Database

/**
 * Description of TestModel
 *
 * @author sabinesteinkamp
 */
class TestModel extends MainModel{
    //put your code here
    
    
    
    public function __construct($dbObj = "") 
    {
        parent::__construct($dbObj);
    }
    
    /**
     * Get data from db
     * @return array 
     */
    public function getDataFromDb() 
    {        
        try {
            $dbResult = $this->dbObj->query("SELECT * FROM tb_hotels");
            $i = 0;
            $resultSet = array();
            foreach ($dbResult as $row) {
                $resultSet[$i] = $row;
                $i++;
            }
            return $resultSet;
        } catch (PDOException $e) {
            echo 'DBError: ' . $e->getMessage();
            die();
        }
    }
    
    /**
     * Insert data into DB table
     * @param string $sInserts 
     */
    public function insertData($sInserts) 
    {
        $objDb = $this->objDb;
        foreach ($sInserts as $insert) {
            $intResult = $objDb->exec($insert);
        }
    }
    
    /**
     * Create db insert statements
     * @param array $aResultList
     * @return array 
     */
    public function getDbInsert($aResultList) 
    {
        $hotelList = $aResultList['RESULT']['ANGEBOT'];
        $inserts = array();
        foreach ($aResultList['RESULT']['ANGEBOT'] as $key => $value) {
            $dbKeys = array();
            $dbValues = "";
            foreach ($value as $key1 => $value1) {
                if ($key1 != "HOTELBEWERTUNG") {
                    $dbKeys[] = $key1;
                    $dbValues .= "'" . $value1 . "',";
                }
            }
            $feldNamen = implode(",", $dbKeys);
            $insertString = str_replace("',)", "')", "INSERT INTO tb_hotels (" . $feldNamen . ") 
                VALUES (" . $dbValues . ")");
            $inserts[] = $insertString;
        }
        return $inserts;
    }
    /**
     * save data in DB
     * @param array $aChangedData 
     */
    public function saveDataToDb($aChangedData) 
    {
        try {
            $sStatement = 'UPDATE tb_hotels SET ';
            $iHowMany = count($aChangedData);
            $i = 1;
            foreach ($aChangedData as $key => $value) {
                if ($i == $iHowMany) {
                    $sStatement .= $key . "='" .$value ."' " ;
                } else {
                    $sStatement .= $key . "='" .$value ."', " ;
                }
                $i++;
            }
            $sStatement .= " WHERE id='" . $aChangedData['id'] . "' ";
            $objDb = $this->objDb;
            $dbResult = $objDb->exec($sStatement);
        } catch (PDOException $e) {
            echo 'DBError: ' . $e->getMessage();
            die();
        }
    }
}

?>
