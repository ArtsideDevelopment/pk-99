<?php
/*   
* libs/classes/ExceptionDataBase.class.php 
* File of extended Exeption classes  
* Файл расширенного класса исключений
* @author Dulebsky A. 05.09.2014   
* @copyright © 2014 ArtSide   
*/
/** 
* Класс для обработки исключений базы данных
* Class db exeption
*/ 
class ExceptionDataBase extends Exception
{
    function HandleExeption($error_func=""){
        // отсылаем содержимое ошибки на email админа
        $e=$this;
        $body="
            <p>Ошибка была вызвана на странице: ".$_SERVER['REQUEST_URI']."</p>
            <p>Функцией: ".$error_func."</p>
            <p>Подробности ошибки:</p>";
        do {
            $body.="
                <p>--------".$e->code."-----------</p> \n
                <p>".$e->message."</p> \n
                <p>File: ".$e->file."</p> \n
                <p>Line: ".$e->line."</p> \n
                <p>---------------------</p> \n
                    ";
        }
        while($e = $e->getPrevious());
        $mail = new Mailer('exeption');
        $mail->sendExeption($body);
        // логирование
        ouputLogFile("mysql.log", "Ошибка при работе с базой данных", $body);
    }
    function GetNoticeExeption($type){
        // Вывод сообщения пользователям
        $notice_arr=array(
            "find_form"=>"
                <div class='notice'>В настоящее время проходят профилактические работы с базой данных. Приносим свои извинения за доставлнные неудобства!</div>",
            "main_menu"=>"
                <nav class='navigation'>
                    <ul class='wrapper'>
                        <li class='dropdown'>
                            <a href='/novostroyki' id='novostroyki'>Новостройки Санкт-Петербурга</a>
                        </li>
                    </ul>
                    <div class='clear'></div>
                </nav>"
            );
        return $notice_arr[$type];
    }
}