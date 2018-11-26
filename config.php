<?php
/*   
* core/config.php 
* Configuration file 
* Конфигурационный файл  
* @author Dulebsky A. 02.06.2015    
* @copyright © 2015 ArtSide   
*/ 

/** 
* Generation of page of an error at access out of system 
* Генерация страницы ошибки при доступе вне системы 
*/ 
if(!defined('AS_KEY')) 
{ 
    header("HTTP/1.1 404 Not Found");      
    exit(file_get_contents('./404.html')); 
} 
     
/*----------------------------------------------------------- 
*              THE GENERAL OPTIONS 
*                  ОбЩИЕ НАСТРОЙКИ 
-----------------------------------------------------------*/

/** 
* Establishes a path to a script root for HTTP 
* Устанавливает путь до корневой директории скрипта 
* по протоколу HTTP 
*/  
    define('AS_HOST', 'http://'. $_SERVER['HTTP_HOST'] .'/');
    define('AS_HOST_CRM', 'http://crm.pk-99.u0096264.plsk.regruhosting.ru/');
    
/** 
* Establishes domain host without http://
* Устанавливает домен без http://
*/  
    define('AS_DOMAIN', trim($_SERVER['HTTP_HOST'], '/')); 
     
/** 
* Establishes a physical path to a root directory of a script 
* Устанавливает физический путь до корневой директории скрипта 
*/  
    define('AS_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
     
/*----------------------------------------------------------- 
*                   CONNECTION ADDITIONAL DB 
*             ПОДКЛЮЧЕНИЕ ДОПОЛНИТЕЛЬНЫХ БАЗ ДАННЫХ
-----------------------------------------------------------*/    
   /** 
   * Database prefix. 
   * Префикс таблиц БД. 
   */    
   define('AS_DBPREFIX', 'as_');  
   
  /** 
   * Example for connection additional database 
   * Пример подключения дополнительной базы 
   */  
   define('AS_DATABASE', 'u0096264_pk_99');     
/** 
* Establishes a company name 
* Устанавливает название кампании
*/  
    define('AS_COMPANY', 'ООО "ПИК99"'); 
    
/** 
* Establishes a system name
* Устанавливает название системы
*/  
    define('AS_SYSTEM_NAME', 'CRM ArtSide'); 

/** 
* Establishes a system img path
* Устанавливает путь к изображениям 
*/  
    define('AS_IMG_PATH', 'http://crm.pk-99.u0096264.plsk.regruhosting.ru'); 
    
/** 
* Establishes a system categories img path
* Устанавливает путь к изображениям категорий
*/  
    define('AS_PRODUCT_CATEGORY_PATH', 'http://crm.pk-99.u0096264.plsk.regruhosting.ru/uploads/images/categories/'); 


    
    