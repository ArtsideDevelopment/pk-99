<?php
/*   
* core/exeptions.php 
* File of global exeption handler 
* Файл для обработки глобальных исключений
* @author Dulebsky A. 07.06.2015   
* @copyright © 2015 ArtSide   
*/
/** 
* Функция для обработки глобальных исключений
* Function for gloabal exception handler
* @param Exception $exception
* @return 
*/ 
function globalExceptionHandler($exception) {
      $body="<h2>Глобальный обработчик исключений</h2>";
      $e=$exception;
      do {
            $body.="
                <p>--------".$e->getCode()."-----------</p> \n
                <p>".$e->getMessage()."</p> \n
                <p>File: ".$e->getFile()."</p> \n
                <p>Line: ".$e->getLine()."</p> \n
                <p>Trace: ".$e->getTraceAsString()."</p> \n
                <p>---------------------</p> \n
                    ";
        }
        while($e = $e->getPrevious());
        $mail = new Mailer('exeption');
        $mail->sendExeption($body);
        //dbg($body);
        // логирование
        // ouputLogFile("error.log", "Глобальная обработка исключений", $body);        
}
set_exception_handler('globalExceptionHandler');