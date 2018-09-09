<div class="content_wrapper grid-12">
    <div class="block-header">Корзина</div>
    <div id="bread-crumbs"><? echo $PAGE->getBreadCrumbs(); ?></div>
    <? echo $PAGE->getContent(); ?>
    <section id="cart" class="cart">
        <ol class="cart__steps">
            <li><a href="/cart">Ваш заказ</a></li>
            <li class="active">Контактные данные</li>
            <li>Способ доставки</li>
            <li>Подтверждение заказа</li>
        </ol>
        <form class="grid-row" action="/cart/step-3/" method="POST" name="cartStep2" id="cartStep2">
            <input type="hidden" name="sid" id="sid" value="<? echo $order_sid;?>">
            <input type="hidden" name="order_tmp_id" id="order_tmp_id" value="<? echo $order_tmp['id'];?>">
            <div class="cart__input">
                <h2>Контактные данные получателя</h2>
                <div class="form-group">
                    <input type="text" name="fio" id="fio" required="required" value="<? echo $order_tmp['fio'];?>">
                    <label class="control-label" for="fio">Фамилия Имя и Отчество*</label><i class="bar"></i>
                </div> 
                <div class="form-group">
                    <input type="text" name="phone" id="phone" required="required" value="<? echo $order_tmp['phone'];?>">
                    <label class="control-label" for="phone">Контактный телефон*</label><i class="bar"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="mail" id="mail" required="required" value="<? echo $order_tmp['mail'];?>">
                    <label class="control-label" for="mail">e-mail*</label><i class="bar"></i>
                </div> 
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="privacy_policy_agree">
                        <i class="helper"></i>Я даю свое согласие на обработку персональных данных и соглашаюсь с условиями и политикой конфиденциальности
                    </label>
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
                    <textarea name="comments" id="comments" ></textarea>
                    <label class="control-label" for="comments">Комментарии к заказу</label><i class="bar"></i>
                </div> 
                <input type="submit" name="send_form" id="send_form" class="button" value="Продолжить оформление >>" />                
            </div>            
            
        </form>
    </section>    
</div>