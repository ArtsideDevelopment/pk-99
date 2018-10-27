<?php
/*   
* libs/shop_func.php 
* File of shop functions  
* Файл функций управления разделом "Магазин"
* @author ArtSide 07.05.2018   
* @copyright © 2018 ArtSide   
*/

/** 
* Функция получения блока категорий 
* function get categories block
* @param 
* @return string 
*/ 
function getCategoriesBlock($parent_id=0){
    $categories_block="";
    try{        
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT *   
            FROM `". AS_DBPREFIX ."catalog` 
            WHERE `parent_id`='".$parent_id."' 
            ORDER BY `hierarchy` "  
                );        
    }
    catch (ExceptionDataBase $edb){
        throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
    }    
    if($res->num_rows>0){
        $categories_block='<ul>';
        while($row = $res->fetch_assoc()){
            $categories_block.='
                <li>
                    <a class="img-block" href="/'.$row['url_path'].'">
                        <img alt="" src="'.AS_PRODUCT_CATEGORY_PATH.'thumb_'.$row['img'].'"/>
                    </a>
                    <a href="/'.$row['url_path'].'">'.$row['name'].'</a>
                </li>';
        }
        $categories_block.='</ul>';
    }
    return $categories_block;
}
/** 
* Функция получения блока категорий 
* function get categories block
* @param 
* @return string 
*/ 
function getCategoriesProducts($category_id=0){
    $products_block="";
    try{        
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT 
                products.id, name, url_path, as_vendor_id, cost, cost_old, amount, characteristic, thumb_img, announce
            FROM 
                ". AS_DBPREFIX ."product_categories AS product_categories
            JOIN
                ". AS_DBPREFIX ."products AS products
            ON
                products.id=product_categories.as_products_id
            WHERE 
                product_categories.as_catalog_id=".check_form($category_id)."
            "  
        );        
    }
    catch (ExceptionDataBase $edb){
        throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
    }    
    if($res->num_rows>0){
        while($row = $res->fetch_assoc()){
            $products_block.='
                <section class="product">
                    <div class="product-img"><img alt="'.$row['name'].'" src="'.AS_PRODUCT_IMG_PATH."/".$row['thumb_img'].'"/></div>
                    <div class="product-description">
                        <a href="/'.$row['url_path'].'" class="product-name">'.$row['name'].'</a>
                        <p class="product-characteristic">'.htmlspecialchars_decode($row['characteristic']).'</p>
                        <p class="product-manufacturer">производитель: <a href="#">ПИК-99</a></p>
                        <p class="product-announcement">'.htmlspecialchars_decode($row['announce']).'</p>
                        <a class="product-link-announcement" href="/'.$row['url_path'].'">подробнее>></a>
                    </div>
                    <div class="product-price">
                        '.  getProductCostBlock($row['cost'], $row['cost_old']).'
                        <!--<div>1 190 <span>руб</span></div>-->
                        '.  getProductBuyBlock($row['id'], $row['cost'], $row['amount']).'
                        <form>
                            <div class="form-group">
                                <select>                                               
                                    <option selected="selected">Выберите</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                                <i class="bar"></i>
                            </div>                                          
                        </form>
                        <div class="product-link">
                            <p>вар.1=КМФ | вар.2=хаки</p>
                        </div>
                    </div>
                </section>
                ';
        }
    }
    return $products_block;
}
/** 
* Функция получения блока с ценой
* Function get cost block
* @param
* @return string 
*/ 
function getProductCostBlock($cost, $cost_old=0){           
    $cost_block='';
    if($cost_old*1>0){
        $cost_block='
            <div class="product-old-price">'.$cost_old.' <span>руб.</span></div>
            <div class="product-new-price">'.$cost.' <span>руб.</span></div>
        ';
    }
    else{
        $cost_block='
            <div class="product-cur-price">'.$cost.' <span>руб.</span></div>
        ';        
    }   
    return $cost_block;
}
/** 
* Функция получения блока с кнопкой оформления товара
* Function get buy btn block 
* @param
* @return string 
*/ 
function getProductBuyBlock($product_id, $cost, $amount=0){           
    $buy_block='';
    $sid = $_COOKIE["sid"];
    if($amount*1>0){
        $buy_block='
            <a href="javascript:void(null);" onclick="xajax_Add_To_Cart(\'sid='.$sid.'&product_id='.$product_id.'&amount='.$amount.'&cost='.$cost.'\');  return false;" class="button">купить</a>
            <a href="#" class="button-gray">заказ в 1 клик</a>
        ';
    }
    else{
        $buy_block='
            <a href="javascript:void(null);" class="button-gray">увы, закончились</a>
        ';        
    }   
    return $buy_block;
}
/** 
* Функция получения изображения товара
* Function get product img
* @param
* @return string 
*/ 
function getProductImgBlock($img="", $product_name){           
    $img_block='';
    if(strlen(trim($img))>0){
        $img_block='
            <img alt="'.$product_name.'" src="'.trim(AS_PRODUCT_IMG_PATH,'/').'/'.trim($img,'/').'"/>
        ';
    }      
    return $img_block;
}
/** 
* Функция получения ссылки под товаром
* Function product bottom link
* @param
* @return string 
*/ 
function getProductLinkBlock($button_link_show_set=0, $button_link_text, $button_link){           
    $link_block='';
    if(strlen(trim($button_link_text))>0 && strlen(trim($button_link))>0 && $button_link_show_set*1>0){
        $link_block='
            <a href="'.htmlspecialchars_decode($button_link).'">'.htmlspecialchars_decode($button_link_text).'</a>
        ';
    }      
    return $link_block;
}
/** 
* Функция получения блока описания для изображения
* Function product text block
* @param
* @return string 
*/ 
function getTextBlock($text){           
    $text_block='';
    if(strlen(trim($text))>0 ){
        $text_block=str_replace('/uploads', AS_PRODUCT_IMG_PATH.'/uploads', htmlspecialchars_decode($text));
        //$text_block = htmlspecialchars_decode($text);
    }      
    return $text_block;
}
/** 
* Функция получения блока с артикулом
* Function product vendor code block
* @param
* @return string 
*/ 
function getVendorCodeBlock($vendor_code){           
    $vendor_code_block='';
    if(strlen(trim($vendor_code))>0 ){
        $vendor_code_block='<p class="product-vendor-code">Артикул: '.$vendor_code.'</p>';
    }      
    return $vendor_code_block;
}