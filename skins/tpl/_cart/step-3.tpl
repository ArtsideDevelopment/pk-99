<div class="content_wrapper grid-12">
    <div class="block-header">Корзина</div>
    <div id="bread-crumbs"><? echo $PAGE->getBreadCrumbs(); ?></div>
    <? echo $PAGE->getContent(); ?>
    <section id="cart" class="cart">
        <ol class="cart__steps">
            <li><a href="/cart">Ваш заказ</a></li>
            <li><a href="/cart/step-2">Контактные данные</a></li>
            <li class="active">Способ доставки</li>
            <li>Подтверждение заказа</li>
        </ol>
        <form class="grid-row" action="/cart/step-4/?access=form" method="POST" name="cartStep3" id="cartStep3">  
            <input type="hidden" name="order_tmp_id" id="order_tmp_id" value="<? echo $order_tmp_id;?>">
            <input type="hidden" name="sid" id="sid" value="<? echo $order_sid;?>">
            <div class="cart__input">
                <h2>Способ доставки</h2>
                <div class="form-group">
                    <select name="as_delivery_method_id" id="as_delivery_method_id" onchange="xajax_Change_Delivery_Method(xajax.getFormValues('cartStep3'));">
                        <option value="0">---------</option>
                        <option value="1">Доставка до пункта самовывоза в вашем городе </option>
                        <option value="2">Доставка курьером по Санкт-Петербургу и Москве </option>
                        <option value="3">Доставка курьером ЕМС по всей РФ</option>
                        <option value="4">Доставка транспортной организацией</option>
                        <option value="5">Доставка Почтой России</option>
                    </select>
                    <label class="control-label" for="as_delivery_method_id">Способ доставки*</label><i class="bar"></i>
                </div> 
                <div class="form-group">
                    <select name="as_payment_method_id" id="as_payment_method_id">
                         <option value="0">---------</option>
                        <option value="1">Оплата при получении</option>
                        <option value="2">Предоплата</option>
                    </select>
                    <label class="control-label" for="as_payment_method_id">Способ оплаты*</label><i class="bar"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="city" id="city" required="required">
                    <label class="control-label" for="city">Город*</label><i class="bar"></i>
                </div>   
                <div id="address_replace"></div>  
                <div id="sdk_block">
                    <div id="forpvz" style="width:100%; height:600px;"></div>
                </div>
            </div>
            <div class="cart__goods">
                <h2>Товары</h2>
                <div id="goods_block_replace">
                    <? echo $cart_goods; ?>
                </div>
                <!--<div class="cart__goods-description">
                    <table >
                        <tr>
                            <td>Фото</td>
                            <td>
                                <p>Рюкзак Deuter AC Light 20 Рюкзак Deuter AC Light 20<a href="javascript:void(null);" onclick="xajax_Delete_Cart_Product(); return false;" class="cart__goods-del">x</a></p>
                                <span class="cart__goods-amount">1 шт.</span>
                                <span class="cart__goods-cost">3 458 р.</span>                                                              
                            </td>                                                        
                        </tr>
                    </table>
                </div>                
                <div class="cart__goods-total">
                    <table>
                        <tr>
                            <td>Итого к оплате:</td>
                            <td>3 458 р.</td>                                                        
                        </tr>
                    </table>
                </div>
                -->
                <div class="form-group">
                    <textarea name="comments" id="comments" ><? echo $comments; ?></textarea>
                    <label class="control-label" for="comments">Комментарии к заказу</label><i class="bar"></i>
                </div> 
                <input type="submit" name="send_form" id="send_form" class="button" value="Продолжить оформление >>" />                
            </div>            
            
        </form>
    </section>    
</div>