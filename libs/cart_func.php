<?php
/*   
* libs/cart.php 
* File of cart functions
* Файл функции корзины
* @author ArtSide Dulebsky A. 22.05.2014   
* @copyright © 2014 ArtSide   
*/
function getCartInfo($sid){
    $cart_array= array(
        'num'=>0, 
        'sum'=>0       
    );
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT 
                cart.amount, products.cost
            FROM 
                ". AS_DBPREFIX ."cart AS cart
            JOIN
                ". AS_DBPREFIX ."products AS products
            ON
                products.id=cart.as_products_id
            WHERE
                cart.sid='".check_form($sid)."'
            ");
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);        
    } 
    $num=0;
    $sum=0;
    if($res->num_rows>0){
        while ($row=$res->fetch_assoc()){
           $num+= $row['amount'];
           $sum+= $row['cost'];
        }
    }   
    $cart_array['num']=$num;
    $cart_array['sum']=$sum;
    return $cart_array;
}
/* 
* Функция полчуения списка товаров в корзине
* Function get cart list
* @param string $sid 
* @return xajaxResponse 
*/ 
function getCartList($sid){
    $cart_list="";
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
                SELECT  
                    cart.id,                    
                    cart.amount,                    
                    products.name,
                    products.cost,
                    products.thumb_img
                FROM 
                    ".AS_DBPREFIX."cart as cart
                join
                    ".AS_DBPREFIX."products as products
                on
                    cart.as_products_id=products.id                
                WHERE 
                    cart.sid='".check_form($sid)."' ");
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
        $cart_list.=DialogMsg::DbError;
        return $cart_list;
    }
    $products_num=$res->num_rows;
    $i=0;
    if($products_num>0){       
        $total_cost=0;
        $cart_list='
            <table class="mobile-no-display step-1">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Стоимость</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            ';
      while($row= $res->fetch_assoc()){  
          $product_total_cost=$row['cost']*$row['amount'];
          $total_cost+=$product_total_cost;
          $i++;
          $cart_list.='
                <tr>
                    <td><img src="'.AS_IMG_PATH.'/'.$row['thumb_img'].'"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['cost'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$product_total_cost.'</td>
                    <td><a href="javascript:void(null);" onclick="xajax_Delete_Cart_Product(\'sid='.$sid.'&cart_id='.$row['id'].'&block=cart_list\'); return false;">Удалить</a></td>
                </tr>
                ';
      }
      $cart_list.='
            <tfoot>
                <tr>                    
                    <td colspan="4">Стоимость</td>
                    <td>'.$total_cost.'</td>
                    <td></td>
                </tr>
            </tfoot>
            </table>
            ';
    }
    else{
        $cart_list.="<h2>Ваша корзина пуста</h2>";
    } 
    return $cart_list;
}
/* 
* Функция полчуения списка товаров в корзине
* Function get cart list
* @param string $sid 
* @return xajaxResponse 
*/ 
function getCartGoodsBlock($sid){
    $cart_goods="";
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT  
                cart.id,                    
                cart.amount,                    
                products.name,
                products.cost,
                products.thumb_img
            FROM 
                ".AS_DBPREFIX."cart as cart
            join
                ".AS_DBPREFIX."products as products
            on
                cart.as_products_id=products.id                
            WHERE 
                cart.sid='".check_form($sid)."' ");
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
        $cart_goods.=DialogMsg::DbError;
        return $cart_goods;
    }
    $products_num=$res->num_rows;
    $i=0;
    if($products_num>0){       
        $total_cost=0;
        $cart_goods='
            <div class="cart__goods-description">
                <table >
            ';
      while($row= $res->fetch_assoc()){  
          $product_total_cost=$row['cost']*$row['amount'];
          $total_cost+=$product_total_cost;
          $i++;
          $cart_goods.='
                <tr>
                    <td valign="top"><img src="'.AS_IMG_PATH.'/'.$row['thumb_img'].'"></td>
                    <td valign="top">
                        <p>'.$row['name'].'<a href="javascript:void(null);" onclick="xajax_Delete_Cart_Product(\'sid='.$sid.'&cart_id='.$row['id'].'&block=goods_block\'); return false;" class="cart__goods-del">x</a></p>
                        <span class="cart__goods-amount">'.$row['amount'].' шт.</span>
                        <span class="cart__goods-cost">'.$row['cost'].' р.</span>                                                              
                    </td>                                                        
                </tr>                
                ';
      }
      $cart_goods.='
                </table>
            </div>                
            <div class="cart__goods-total">
                <table>
                    <tr>
                        <td>Итого к оплате:</td>
                        <td>'.$total_cost.' р.</td>                                                        
                    </tr>
                </table>
            </div>            
            ';
    }
    else{
        $cart_goods.="<p>Ваша корзина пуста</p>";
    } 
    return $cart_goods;
}
/** 
* Функция проверки нал
* Function get user salary table
* @param
* @return string 
*/ 
function  chechAvailability($sid, $product_id){
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT  `amount`
            FROM 
                `". AS_DBPREFIX ."cart` 
            WHERE 
                `sid`='".check_form($sid)."' AND `as_products_id`='".check_form($product_id)."' ");
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
    }    
    if($res->num_rows>0){
        $row=  $res->fetch_array();
        return $row[0];
    }
    else {
         return 0;
    }   
}

/* 
* Функция добавления коyнтактных данных в заказ
* Function add contats to order
* @param string $Id 
* @return xajaxResponse 
*/ 
function addContatcsToOrderTmp($sid, $order_tmp_id, $fio, $phone, $mail)
{  
    require_once(AS_ROOT .'libs/security.php'); 
    if($order_tmp_id ===0){
        try{
            $res = DB::mysqliQuery(AS_DATABASE,"
                INSERT INTO
                    `". AS_DBPREFIX ."orders_tmp` 
                SET 
                    `sid`='".check_form($sid)."',
                    `fio`='".check_form($fio)."', 
                    `phone`='".check_form($phone)."', 
                    `mail`='".check_form($mail)."'
                "
              ); 
        }
        catch (ExceptionDataBase $edb){
            $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
            return 0;
        } 
        $order_tmp_id = DB::getInsertId();  
    }
    else{
        $res = DB::mysqliQuery(AS_DATABASE,"
            UPDATE
                `". AS_DBPREFIX ."orders_tmp` 
            SET 
                `sid`='".check_form($sid)."',
                `fio`='".check_form($fio)."', 
                `phone`='".check_form($phone)."', 
                `mail`='".check_form($mail)."'
            WHERE
                `id`=".check_form($order_tmp_id)."
            "
          ); 
    }      
    return $order_tmp_id;
}
/* 
* Функция добавления способа доставки в заказ
* Function add delivery metod to order
* @param string $Id 
* @return xajaxResponse 
*/ 
function addDeliveryToOrderTmp($order_tmp_id, $as_delivery_method_id, $as_payment_method_id, $city, $delivery_address, $comments)
{  
    require_once(AS_ROOT .'libs/security.php');
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            UPDATE
                `". AS_DBPREFIX ."orders_tmp` 
            SET 
                `as_delivery_method_id`='".check_form($as_delivery_method_id)."',
                `as_payment_method_id`='".check_form($as_payment_method_id)."', 
                `city`='".check_form($city)."', 
                `delivery_address`='".check_form($delivery_address)."',
                `comments`='".  check_form($comments)."'
            WHERE
                `id`=".check_form($order_tmp_id)."
            "
          ); 
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
        return 0;
    }
    return $order_tmp_id;
}
/* 
* Функция получения информации по заказу
* Function ger order tmp info
* @param string $Id 
* @return xajaxResponse 
*/ 
function getOrderTmpInfo($sid)
{  
    require_once(AS_ROOT .'libs/security.php'); 
    $row_tmp = array( //переменные для записи в базу информации по странице
        "id"=>0, 
        "fio"=>"", 
        "phone"=>"", 
        "mail"=>"",
        "city"=>"",
        "delivery_address"=>""
    );
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT  
                `id`, `fio`, `phone`, `mail`, `city`, `delivery_address`
            FROM `". AS_DBPREFIX ."orders_tmp` 
            WHERE `sid`='".check_form($sid)."' 
            "
          );   
    }
    catch (ExceptionDataBase $edb){
        $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
        return $row_tmp;
    }
    if($res->num_rows>0){
        $row=  $res->fetch_array();
    }
    else{
         $row = $row_tmp;
    }

    return $row;
}