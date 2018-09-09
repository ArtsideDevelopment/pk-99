<div class="content_wrapper grid-10">
    <div class="block-header">Интернет-магазин</div>
    <div id="bread-crumbs"><a href="/">Главная</a><!--<? echo $PAGE->getBreadCrumbs(); ?>--></div>
    <? echo $content_block; ?>
    <section id="catalog" class="shop">
        <section id="categories">
            <? echo $categories_block; ?>
        </section>
        <section id="goods">
            <div id="goods-sorting">Сортировать по: наименованию (<a href="#">возр</a><span>|</span><a href="#">убыв</a>), цене (<a href="#">возр</a><span>|</span><a href="#">убыв</a>)</div>
            <? echo $categories_products; ?>
        </section>
    </section>
</div>