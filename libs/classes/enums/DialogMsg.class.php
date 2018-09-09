<?php
/*   
* libs/classes/enums/JobType.class.php 
* File of the JobType class  
* @author Dulebsky A. 06.09.2016   
* @copyright © 2016 ArtSide   
*/
/** 
* Класс перечислений типов работ. Значение констант получаем из таблицы content - id соответсвующих страниц
* Class jon type enum
* @param  
*/ 
class DialogMsg extends Enum
{    
    const ProductAddToCart='
        <h3>Товар добавлен в корзину</h3>
        <a href="javascript:void(null);" class="button-gray">Продолжить покупки</a>
        <a href="/cart" class="button">Перейти в корзину</a>
        ';
    const DbError='
           <h2>В настоящее время ведуться технические работы</h2>
           <p>Прямо сейчас мы что-то улучшаем, либо внедряем новый функционал в 
           наш интернет-магазин, чтобы пользоваться им было еще удобнее. Попробуйте 
           обновить страницу через несколько минут.  </p>
           ';
    const absent="3";
}
