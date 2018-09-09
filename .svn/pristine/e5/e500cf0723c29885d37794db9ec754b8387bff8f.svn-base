<!DOCTYPE html>
<!--

-->
<html lang="ru">
    <head>
        <title><? echo $PAGE->getTitle(); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="canonical" href="<?php echo $PAGE->getCanonicalUrl(); ?>"/>
        <meta name="description" content="<? echo $PAGE->getMetaDescription(); ?>">
        <meta name="keywords" content="<? echo $PAGE->getMetaKeywords(); ?>">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper">
            <?php include AS_GENERAL_HEADER; ?>
            <nav id="mobile-catalog-menu">
                <i class="icon-folder"></i><a href="#">Каталог товаров</a> <i class="icon-arrow-down"></i>
            </nav>
            <article id="offer">
                <img src="/skins/img/main-banner.jpg" alt="Выпускаем снаряжение с 1998 года" />
                
            </article>
            <article id="offer-mobile">
                <img src="/skins/img/main-banner-mobile.jpg" alt="Выпускаем снаряжение с 1998 года" />
                
            </article>
            <div class="grid-row">                                                               
                <? echo $content?>     
            </div>
            <?php include AS_GENERAL_FOOTER; ?>
        </div>
        <?php include AS_GENERAL_MODAL_DIALOG; ?>
        <link rel="stylesheet" href="/skins/css/styles.css">
        <script src="https://yastatic.net/jquery/2.2.0/jquery.min.js"></script>
        <script src="/skins/js/libs/jquery.swipebox.js"></script>
        <script src="/skins/js/core.js"></script>
        <script id="ISDEKscript" type="text/javascript" src="https://www.cdek.ru/website/edostavka/template/js/widjet.js"></script>
        <?php $xajax->printJavascript(); ?>
        <script type="text/javascript">
            var widjet = new ISDEKWidjet({
                defaultCity: 'Санкт-Петербург',
                cityFrom: 'Омск',
                country: 'Россия',
                link: 'forpvz',
                choose: true,
                hidedress: true,
                hidecash: true,
                hidedelt: true,
                onChoose: onChoose,
                path: 'https://www.cdek.ru/website/edostavka/template/scripts/', //директория с бибилиотеками
                servicepath: '/libs/service.php' //ссылка на файл service.php на вашем сайте
            });
            function onChoose(wat) {
                var choosen=wat.id;
                var city=wat.cityName;                
                $('#address').val(choosen);
                //$('#city').val(city);
            }
            function showSDK(){
                $('#sdk_block').show();
            }
        </script>
    </body>
</html>
