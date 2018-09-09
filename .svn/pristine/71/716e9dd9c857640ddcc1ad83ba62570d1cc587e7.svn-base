<?php
/*   
* ../index.php 
* Main router   
* Основной роутер  
* @author ArtSide Dulebsky A. 14.06.2015   
* @copyright © 2015 ArtSide   
*/
/**   
* We establish the charset and level of errors   
* Устанавливаем кодировку и уровень ошибок   
*/   
    header("Content-Type: text/html; charset=utf-8");
    error_reporting(E_ALL);
/**   
* Installation of a key of access to files   
* Установка ключа доступа к файлам   
*/ 
    define('AS_KEY', true);
/**  
* We connect a configuration file  
* Подключаем конфигурационный файл  
*/ 
    require_once('./config.php');
/**  
* We connect a file of autoload function 
* Подключаем файл с автооматической загрузкой классов
*/      
    include AS_ROOT .'libs/autoload.php'; 
/**   
* We connect exeptions file     
* Подключаем файл исключений
*/      
    include_once AS_ROOT .'libs/exceptions.php';
/**    
* Debug    
* Дебаггер   
* @TODO To clean in release   
*/ 
    define('AS_TRACE', true);
    require_once(AS_ROOT.'libs/debug.php'); 
/**  
* We connect a file of sequriy functions  
* Подключаем файл функции безопасности
*/      
    include AS_ROOT .'libs/security.php';
    
/**   
    * We connect a file of the xajax lib   
    * Подключаем файл xajax библиотеки  
    */        
    $xajax = new xajax();	
    require_once(AS_ROOT .'libs/xajax/xajax_for_all_func_inc.php'); 
    require_once(AS_ROOT .'libs/xajax/xajax_cart_func_inc.php');
    $xajax->processRequest();
    $xajax->configure('javascript URI','/libs/xajax');
/**  
* We connect a file of routing functions  
* Подключаем файл маршрутизации 
*/      
    $content = Router::startRoute();
    //$content = Router::startRoute('modules',$PAGE->getController());
    //$controller = Router::getController();
    //dbg($controller);
/**  
* We connect a file of initialization of variables  
* Подключаем файл инициализации переменных  
*/     
    include AS_ROOT .'libs/variables.php'; 

    include AS_ROOT .'skins/tpl/'.  Router::getView().'/index.tpl';
