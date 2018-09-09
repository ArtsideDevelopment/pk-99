<?php
/* 
* Функция добавления товара в корзину
* Function add product to cart
* @param string $Id 
* @return xajaxResponse 
*/ 
function Add_To_Cart($Id)
{
  $objResponse = new xajaxResponse();
  require_once(AS_ROOT .'libs/security.php'); 
  require_once(AS_ROOT .'libs/cart_func.php'); 
  parse_str($Id);//sid;product_id;amount;cost
  $amount_sql=chechAvailability($sid, $product_id);
  if($amount_sql>0){
      $amount+=$amount_sql;
      $res = DB::mysqliQuery(AS_DATABASE,"
            UPDATE 
                `". AS_DBPREFIX ."cart` 
            SET 
                `amount`=".check_form($amount)."
            WHERE 
                `sid`='".check_form($sid)."' && `as_products_id`=".check_form($product_id)." "
          ); 
  }
  else{
      $res = DB::mysqliQuery(AS_DATABASE,"
            INSERT INTO
                `". AS_DBPREFIX ."cart` 
            SET 
                `sid`='".check_form($sid)."', 
                `as_products_id`=".check_form($product_id).", 
                `amount`=".check_form($amount).",
                `cost`=".check_form($cost)."
            "
          ); 
  }
  $cart_arr = getCartInfo($sid);
  $cart_num= $cart_arr['num'];
  $cart_sum= $cart_arr['sum'];
  $objResponse->assign("cart_amount","innerHTML", $cart_num);
  $objResponse->assign("cart_sum","innerHTML", $cart_sum);
  $objResponse->assign("modal_content_replace","innerHTML", DialogMsg::ProductAddToCart);
  $objResponse->call("modal_dialog_show");
  /*------------------------------------------------------------------*/	  
   return $objResponse;
}
/* 
* Функция контроля выбора способа доставки
* Function control change delivery method
* @param array $Id 
* @return xajaxResponse 
*/ 
function Change_Delivery_Method($Id){
    $objResponse = new xajaxResponse();    
    //$contact_person_block = getContactPersonBlock($Id['as_clients_id']);  
    $adress_block='';
    if($Id['as_delivery_method_id']*1==1){
        $adress_block='
            <div class="form-group">
                <input type="text" name="address" id="address" required="required">
                <label class="control-label" for="address">Адрес пункта самовывоза*</label><i class="bar"></i>
            </div>';
    }
    else{
        $adress_block='
            <div class="form-group">
                <input type="text" name="address" id="address" required="required">
                <label class="control-label" for="address">Адрес доставки*</label><i class="bar"></i>
            </div>';
    }
    $objResponse->assign("address_replace","innerHTML",$adress_block);
    $objResponse->call("showSDK()"); 
    return $objResponse;
}
/* 
* Функция удаления товара из корзины
* Function delete product from cart
* @param array $Id 
* @return xajaxResponse 
*/ 
function Delete_Cart_Product($Id)
{
  $objResponse = new xajaxResponse(); 
  // проверяем все входящие переменные на наличие xss и sql инъекции 
  parse_str($Id);//sid;cart_id;block
  if($cart_id*1>0){ 
        try{             
            $res = DB::mysqliQuery(AS_DATABASE,"
              DELETE FROM   
                `". AS_DBPREFIX ."cart` 
              WHERE                                              
                   `id`=".$cart_id."                                        
                    ");            
        }
        catch (ExceptionDataBase $edb){
            $edb->HandleExeption(__FILE__."->".__FUNCTION__."->".__LINE__);
            $dialog_msg = DialogMsg::DbError;
        } 
        include_once AS_ROOT .'libs/cart_func.php';
        if($block=='cart_list'){
            $cart_list = getCartList($sid);
            $objResponse->assign("cart_list_replace","innerHTML",  $cart_list);
        }
        elseif($block=='goods_block'){
            $goods_block = getCartGoodsBlock($sid);
            $objResponse->assign("goods_block_replace","innerHTML",  $goods_block);
        }        
  } 
  return $objResponse;
}