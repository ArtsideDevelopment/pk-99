<?php
/**  modules/_content/read_controller.php
* Controller  
* Контроллер  
* @author Dulebsky A. 14.06.2015   
* @copyright © 2015 ArtSide 
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
    include_once AS_ROOT .'libs/cart_func.php';
    $PAGE = Page::getInstance(Router::getUrlPath()); 
    $order_sid = isset($_POST['sid']) ? $_POST['sid'] : 0;
    $order_tmp_id = isset($_POST['order_tmp_id']) ? $_POST['order_tmp_id'] : 0;
    $fio = isset($_POST['fio']) ? $_POST['fio'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $comments = isset($_POST['comments']) ? $_POST['comments'] : '';
    $order_tmp_id = addContatcsToOrderTmp($order_sid, $order_tmp_id, $fio, $phone, $mail);
    $cart_goods = getCartGoodsBlock($order_sid);
    