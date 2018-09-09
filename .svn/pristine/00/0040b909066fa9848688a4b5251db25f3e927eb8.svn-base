<?php
/*   
* /libs/mysqli.php 
* File of MySql functions 
* Файл работы с базой данных 
* @author ArtSide Dulebsky A. 15.08.2012    
* @copyright © 2012 ArtSide   
*/
/**   
* Connection and installation of chaeset of connection 
* Подключение и установка кодировок соединения  
*/
/*
$mysqli = new mysqli(AS_DBSERVER, AS_DBUSER, AS_DBPASSWORD, AS_DATABASE);
if ($mysqli->connect_errno) {  
    throw new ExceptionDataBase("Не удалось подключиться к базе данных");
}
$mysqli->query('SET NAMES utf8');          
$mysqli->query('SET CHARACTER SET utf8');  
$mysqli->query('SET COLLATION_CONNECTION="utf8_general_ci"');
*/
class DB{ 
    const HOST = "localhost";
    const USER = "u0096_artside";
    const PASS = "ghV8k16#";
    private static $_database;

    public static $mysqli;
    public $sql;

    function __construct($database, $host=null, $user=null, $pass=null) {        
    }
    public static function mysqliConnect($database){
        if (!empty($database)) self::$_database = $database;
        self::$mysqli = new mysqli(self::HOST,  self::USER,  self::PASS, self::$_database);
        if (!self::$mysqli) {
            throw new Exception("Не возможно подключиться к базе данных");
        }
        self::$mysqli->query('SET NAMES utf8');          
        self::$mysqli->query('SET CHARACTER SET utf8');  
        self::$mysqli->query('SET COLLATION_CONNECTION="utf8_general_ci"');
    }
    public static function mysqliSelectDB($database){
        if (!empty($database)) self::$_database = $database;
        if ( !self::$mysqli ){ 
            self::$mysqli = self::mysqliConnect($database);
        }
        self::$mysqli->select_db(self::$_database);
    }
    public static function mysqliQuery($database, $sql) {
        if ( !self::$mysqli ){
            self::$_database = $database;
            self::mysqliConnect(self::$_database);
        }
        elseif(!(self::$_database===$database)){
            self::$_database = $database;
            self::mysqliSelectDB(self::$_database);
        }        
        $result = self::$mysqli->query($sql);
        if ($result === false) {
            throw new ExceptionDataBase("Ошибка в запросе к базе данных: ".self::$mysqli->error."<br/>\n Запрос:".$sql, 1);            
        }
        return $result;        
    }
    /** 
    * Функция получения массива данных из определенной таблицы
    * function get data array from table
    * @param string $table - таблица
    * @param int $table_id - id строки
    * @return array $table_arr 
    */ 
    public static function getTableArray($database, $table, $table_id=0, $pole_name=""){
        $table_arr=array();
        $query="*";
        if(strlen(trim($pole_name))>0){
            $query=$pole_name;
        }
        if($table_id>0){
            try{
                $res = self::mysqliQuery($database,"
                        SELECT 
                            ".$query."  
                        FROM 
                            `". AS_DBPREFIX .$table."` 
                        WHERE 
                            `id`='".$table_id."' "  
                        );
            }
            catch (ExceptionDataBase $edb){
                throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
            } 
            if($res->num_rows>0){
                $table_arr=  $res->fetch_assoc();
            }
        }
        else{
            try{
                $res = self::mysqliQuery(self::$_database,"SHOW COLUMNS   
                        FROM `". AS_DBPREFIX . $table."` "  
                        );
            }
            catch (ExceptionDataBase $edb){
                throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
            } 
            while ($row=  $res->fetch_array())
            {
                $table_arr[$row[0]]="";
            }        
        }
        return $table_arr;
    }
    /** 
    * Функция получения id последнего добавленного элемента
    * function get id of last insert value
    */ 
    public static function getInsertId() {        
        return self::$mysqli->insert_id;
    }  
    public function mysqliClose() {        
        self::$mysqli->close(); 
    }    
}