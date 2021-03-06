<?php
/** 
* Variables file 
* Файл премнных
* @author Dulebsky A.  19.03.2014 
* @copyright © 2014 ArtSide 
*/ 
///////////////////////////////////////////////////////// 
/**  
* Generation of page of an error at access out of system  
* Генерация страницы ошибки при доступе вне системы  
*/  
    if(!defined('AS_KEY'))  
    {  
       Router::routeErrorPage404();
    }  
/////////////////////////////////////////////////////////// 

/**   
* get PAGE instance  
* получаем экземпляр страницы  
*/
    $PAGE = Page::getInstance(Router::getUrlPath());

/** 
* get top menu and left menu
* Получаем верхнее меню и левое меню
*/  
    $main_menu= $PAGE->getTopMenu();  
/** 
* get 4sid
* Получаем $sid
*/ 
     $sid="";
     if(!isset($_COOKIE["sid"]))
     {
         $sid = uniqid();
         setcookie("sid", $sid,  time()+60*60*24*10, "/", AS_DOMAIN);    
     }
     else
     {
         $sid = $_COOKIE["sid"];
     }
     require_once(AS_ROOT .'libs/cart_func.php');
     $CART=  getCartInfo($sid);
    
/**   
* tpl variables   
* переменные шаблона  
*/  
define('AS_GENERAL_HEADER', AS_ROOT .'skins/tpl/_for_all/header.tpl');
define('AS_GENERAL_FOOTER', AS_ROOT .'skins/tpl/_for_all/footer.tpl');
define('AS_GENERAL_MODAL_DIALOG', AS_ROOT .'skins/tpl/_for_all/modal_dialog.tpl');
