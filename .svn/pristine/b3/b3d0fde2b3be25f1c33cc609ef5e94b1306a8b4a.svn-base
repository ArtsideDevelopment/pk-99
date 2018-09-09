<div class="content_wrapper grid-12">
    <div class="block-header">Корзина</div>
    <div id="bread-crumbs"><? echo $PAGE->getBreadCrumbs(); ?></div>
    <? echo $PAGE->getContent(); ?>
    <section id="cart" class="cart">
        <ol class="cart__steps">
            <li><a href="/cart">Ваш заказ</a></li>
            <li><a href="/cart/step-2">Контактные данные</a></li>
            <li><a href="/cart/step-3/?access=link">Способ доставки</a></li>
            <li class="active">Подтверждение заказа</li>
        </ol>
        <form class="grid-row" action="/cart/finish/?access=form" method="POST" name="cartStep4" id="cartStep4"> 
            <input type="hidden" name="order_tmp_id" id="order_tmp_id" value="<? echo $order_tmp_id;?>">
            <div class="cart__input">
                <h2>Подтверждение заказа</h2>
                <table>
                    <tr>
                        <td>
                            Фамилия Имя и Отчество:
                        </td>
                        <td>
                            <? echo $order_tmp['fio'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Контактный телефон:
                        </td>
                        <td>
                            <? echo $order_tmp['phone'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           e-mail:
                        </td>
                        <td>
                            <? echo $order_tmp['mail'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Способ доставки:
                        </td>
                        <td>
                            Доставка до пункта самовывоза в вашем городе
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Способ оплаты:
                        </td>
                        <td>
                            Оплата при получении
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Город:
                        </td>
                        <td>
                            <? echo $order_tmp['city'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Адрес пункта самовывоза:
                        </td>
                        <td>
                            <? echo $order_tmp['delivery_address'];?>
                        </td>
                    </tr>
                </table>
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
                <input type="submit" name="send_form" id="send_form" class="button" value="Оформить заказ >>" />                
            </div>            
            
        </form>
    </section>    
</div>