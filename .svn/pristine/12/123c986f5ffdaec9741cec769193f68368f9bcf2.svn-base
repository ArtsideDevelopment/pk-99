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
    $url_path = Router::getUrlPath();
    if($url_path==='catalog'){
        $PAGE = Page::getInstance($url_path, 'content');
        $categories_block = getCategoriesBlock();
        $categories_products = "";
        $content_block = getTextBlock($PAGE->getContent());
    }
    else{
        $PAGE = Page::getInstance($url_path, 'catalog'); 
        $CATALOG = $PAGE->getPageArray();
        $category_id = $PAGE->getId();
        $categories_block = getCategoriesBlock($category_id);
        $categories_products = getCategoriesProducts($category_id);
        $content_block = getTextBlock($CATALOG['content']);
    }
