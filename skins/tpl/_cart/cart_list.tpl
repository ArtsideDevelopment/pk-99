<div class="content_wrapper grid-12">
    <div class="block-header">Корзина</div>
    <div id="bread-crumbs"><? echo $PAGE->getBreadCrumbs(); ?></div>
    <? echo $PAGE->getContent(); ?>
    <section id="cart" class="cart">
        <ol class="cart__steps">
            <li class="active">Ваш заказ</li>
            <li>Контактные данные</li>
            <li>Способ доставки</li>
            <li>Подтверждение заказа</li>
        </ol>
        <div id="cart_list_replace">
            <? echo $cart_list; ?>
        </div>
        <!--<table class="mobile-no-display step-1">
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
            <tfoot>
                <tr>                    
                    <td colspan="4">Количество</td>
                    <td>Стоимость</td>
                    <td></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Фото</td>
                    <td>Товар</td>
                    <td>Цена</td>
                    <td>Количество</td>
                    <td>Стоимость</td>
                    <td><a href="javascript:void(null);" onclick="xajax_Delete_Cart_Product(); return false;">Удалить</a></td>
                </tr>
            </tbody>
        </table>
        -->        
        <div class="mobile-display">
            
        </div>
        <form class="cart__goods-btn" action="/cart/step-2/" method="POST"> 
            <input type="hidden" name="sid" id="sid" value="<? echo $sid;?>">
            <input type="submit" name="send_form" id="send_form" class="button" value="Продолжить оформление >>" />
        </form>
    </section>
</div>