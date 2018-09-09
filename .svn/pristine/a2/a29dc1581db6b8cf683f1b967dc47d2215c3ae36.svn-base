<?php
/*   
* libs/classes/Router.class.php 
* File of the Router class  
* Файл класса Маршрутизации 
* @author Dulebsky A. 12.06.2015   
* @copyright © 2015 ArtSide   
*/
/** 
* Класс для маршрутизации приложения
* Class for routing application
* @param  
*/ 
class Router{
    const ERROR_CONTROLLER_ROUTER = 'modules/_error/router.php';
    const DEFAULT_CONTROLLER = '_content';
    const DEFAULT_VIEW = '_content';
    static private $_module='modules';
    static private $_skins_tpl='skins/tpl';
    static private $_url_path;
    static private $_controller = '_main';
    static private $_view = '_main';
    static private $_ROUTE = array( 
        'controller' => '',
        'action'   => '', 
        'id'    => 0, 
        'num'   => 0,
    );
    /** 
    * Конструктор класса
    * Class construct
    * @param 
    * @return boolean 
    */ 
    function __construct(){
        
    }
    /** 
    * Функция маршрутизации
    * Functio route
    * @param $module - модуль, если маршрутизация происходит вручную
    * @param $controller - контроллер, если маршрутизация происходит вручную
    * @return boolean 
    */ 
    static public function startRoute($module=NULL, $controller=NULL) 
    { 
        if(!empty($module) && !empty($controller)){
            self::$_module = $module;
            self::$_controller = str_replace('-', '_', $controller);
        }
        else{            
            if(!empty($_GET['route'])){
                self::setUrlPath();
                $route = explode('/', trim($_GET['route'], '/'));
                if($route[0]==='admin'){
                    self::$_module=$route[0];
                    $i=1;
                }
                else{
                    $i = 0;                     
                }
                if(!empty($route[$i])) {
                    $controller_tmp = "";
                    foreach(self::$_ROUTE as $var => $val) 
                    {                             
                        if(!empty($route[$i])) {
                            // Проверяем, существует ли каталог с роутером
                            $controller_tmp.= "/"."_".trim(str_replace('-', '_', $route[$i]),'_');   
                            //dbg($controller_tmp);
                            if (is_dir(AS_ROOT.self::$_module.$controller_tmp)) {
                                self::$_controller = $controller_tmp;                                
                            }
                            elseif($i===0){
                                self::$_controller = self::DEFAULT_CONTROLLER;
                            }
                            if (is_dir(AS_ROOT.self::$_skins_tpl.$controller_tmp)) {
                                self::$_view = $controller_tmp;
                            }
                            elseif($i===0){
                                self::$_view = self::DEFAULT_VIEW;
                            }
                            self::$_ROUTE[$var] = $route[$i];
                        }                                
                        ++$i;    
                    }
                }
            }            
        }
        $content = "";
        try {
            ob_start();
            include self::getControllerRouter();
            $content = ob_get_contents();
            ob_end_clean();
        } catch (ExceptionFiles $ef) {
            $ef->HandleExeption();
            self::routeErrorPage404();
        } 
        //include AS_ROOT .'skins/tpl/'.self::$_controller.'/index.tpl';
        return $content;
    }    
    /** 
    * Функция подключает необходимый контроллер
    * Functio get controller
    * @param 
    * @return boolean 
    */ 
    static public function getControllerRouter() 
    { 
        $controller_router_file = "";
        $controller_router="";
        if(strlen(trim(self::$_module))>0){
            $controller_router .= self::$_module."/";
        }
        if(strlen(trim(self::$_controller))>0){
            //dbg(self::$_controller);
            $controller_router .= trim(self::$_controller,'/')."/";
        }        
        $controller_router .="router.php";
        $controller_router_file = AS_ROOT.strtolower($controller_router);
        if(file_exists($controller_router_file)){
            return $controller_router_file;
        }
        else{
            //self::routeErrorPage404();
            throw new ExceptionFiles("Файл контроллера(".self::$_controller.") не найден: ".$controller_router_file);
        }        
    }    
    /** 
    * Функция подключает название контроллера
    * Functio get controller name
    * @param 
    * @return boolean 
    */ 
    static public function getController() 
    {         
        return self::$_controller;            
    } 
    /** 
    * Функция подключает название шаблона для отображения
    * Functio get view tpl
    * @param 
    * @return boolean 
    */ 
    static public function getView() 
    {         
        return self::$_view;
    } 
    /** 
    * Функция подключает необходимый контроллер
    * Functio get controller
    * @param 
    * @return boolean 
    */ 
    static public function getErrorControllerRouter() 
    { 
          $controller_router_file = AS_ROOT.self::ERROR_CONTROLLER_ROUTER;
          return $controller_router_file;
    }
    /** 
    * Функция получает url_path, щапрошенной страницы
    * Functio get page url_path
    * @param 
    * @return boolean 
    */ 
    static public function setUrlPath() 
    { 
        if(!empty($_GET['route']) && empty(self::$_url_path)){
            self::$_url_path=trim($_GET['route'], '/');
        }
    }   
    /** 
    * Функция получает url_path, щапрошенной страницы
    * Functio get page url_path
    * @param 
    * @return boolean 
    */ 
    static public function getUrlPath(){ 
        if(empty(self::$_url_path)){
            self::setUrlPath();
        }        
        return self::$_url_path;
    }    
    /** 
    * Функция получает action
    * Functio get action
    * @param 
    * @return boolean 
    */ 
    static public function getAction(){                 
        return self::$_ROUTE['action'];
    }    
    /** 
    * Функция перенаправления на страницу 404
    * function route to 404 page
    * @param 
    * @return string 
    */ 
    static public function routeErrorPage404(){ 
        header('HTTP/1.1 404 Not Found');
        //header("Status: 404 Not Found");
        header('Location:'.AS_HOST.'404.html');
        exit();
    }   
    /**  
    * Function of Redirections  
    * Функция перенаправления  
    */       
    static public function reDirect($url_path="")  
    {   
        $host = AS_HOST;  
        if(strlen(trim($url_path))>0){
            $host .=$url_path;
            header('location: '. $host);
        }
        else{
            $url_path = self::getUrlPath();       
            $host .=$url_path;
            header('location: '. $host); 
        }         
        exit(); // Останавливаем скрипт  
    }    
}
