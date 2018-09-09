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
    include_once AS_ROOT .'libs/shop_func.php';
    $PAGE = Page::getInstance(Router::getUrlPath(), 'products');
    $PRODUCT = $PAGE->getPageArray();
    $cost_block = getProductCostBlock($PRODUCT['cost'], $PRODUCT['cost_old']);
    $buy_block = getProductBuyBlock($PRODUCT['id'], $PRODUCT['cost'], $PRODUCT['amount']);
    $img_block = getProductImgBlock($PRODUCT['img'], $PRODUCT['name']);
    $link_block = getProductLinkBlock($PRODUCT['button_link_show_set'], $PRODUCT['button_link_text'], $PRODUCT['button_link']);
    $description_block = getTextBlock($PRODUCT['description']);
    $vendor_code_block = getVendorCodeBlock($PRODUCT['vendor_code']);