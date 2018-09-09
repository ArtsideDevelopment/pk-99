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
    $access = isset($_GET['access']) ? $_GET['access'] : 'none';    
    if($access=='form') {
        $order_tmp_id = isset($_POST['order_tmp_id']) ? $_POST['order_tmp_id'] : 0;
        $order_sid = isset($_POST['sid']) ? $_POST['sid'] : 0;
        $as_delivery_method_id = isset($_POST['as_delivery_method_id']) ? $_POST['as_delivery_method_id'] : 0;
        $as_payment_method_id = isset($_POST['as_payment_method_id']) ? $_POST['as_payment_method_id'] : 0;
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $comments = isset($_POST['comments']) ? $_POST['comments'] : '';
        $order_tmp_id = addDeliveryToOrderTmp($order_tmp_id, $as_delivery_method_id, $as_payment_method_id, $city, $address, $comments);
        $comments = isset($_POST['comments']) ? $_POST['comments'] : '';
        $cart_goods = getCartGoodsBlock($order_sid);
        $order_tmp = getOrderTmpInfo($order_sid);
    }
    else{
        Router::reDirect('/cart');
    }
   