<?php
/*   
* libs/classes/Page.class.php 
* File of the Page class  
* Файл класса для работы со страницей 
* @author Dulebsky A. 15.06.2015   
* @copyright © 2015 ArtSide   
*/
class Page{ 
    private static $_table;
    private static $_title;
    private static $_meta_description;
    private static $_meta_keywords;
    private static $_description;
    private static $_content;
    private static $_offer;
    private static $_canonical_url='';
    private static $_controller='';
    private static $_sub_menu_arr=array();
    private static $instance;
    private static $instance_url_path;
    private static $_page_arr=array();
    private static $_menu_arr=array();
    private static $_menu_tree=array();
    private static $_header_menu;
    private static $_footer_menu;
    private static $_catalog_menu_arr=array();
    private static $_catalog_menu_tree=array();

    /** 
    * Конструктор класса
    * Class construct
    * @param 
    * @return boolean 
    */ 
    private function __construct($url_path, $table='content'){
        $query ="";
        try{
            if(empty($url_path)){
                $query = "`default_set`=1";                
            }
            else{
                $query = "`url_path`='".check_form($url_path)."'";
            }
            $res = DB::mysqliQuery(AS_DATABASE,"
                SELECT 
                    *
                FROM 
                    `". AS_DBPREFIX.$table."` 
                WHERE 
                    ".$query." 
            "); 
        }
        catch (ExceptionDataBase $edb){
            throw new ExceptionDataBase("Ошибка в стеке запросов к базе данных",2, $edb);
        }
        self::$_table = $table;
        if($res->num_rows==1){
            $row = $res->fetch_assoc();
            self::$instance_url_path = trim($url_path,'/');
            self::$_page_arr = $row;
            self::$_title = $row['title'];
            self::$_meta_description = $row['meta_description'];   
            self::$_meta_keywords = $row['meta_keywords'];
            self::$_content = (isset($row['content'])) ? $row['content']: '';
            self::$_canonical_url = AS_DOMAIN."/".$row['url_path'];
            if(isset($row['controller'])){
                if(strlen(trim($row['controller']))>0){
                    self::$_controller = $row['controller'];
                }
            }
        }
        else{
            Router::routeErrorPage404();
        }
    }  
    public static function getInstance($url_path, $table='content'){
        if ( empty(self::$instance) || self::$instance_url_path!=trim($url_path,'/')){
            self::$instance = new Page($url_path, $table);            
        }
        return self::$instance;        
    }
    /** 
    * Функция устанавливает title страницы
    * Function set page title
    * @param 
    * @return boolean 
    */ 
    static public function setTitle($title){                
        self::$_title = $title;
    } 
    /** 
    * Функция получает title страницы
    * Functio get page title
    * @param 
    * @return boolean 
    */ 
    public function getTitle(){                
        return self::$_title;
    }  
    /** 
    * Функция получает meta_description страницы
    * Functio get page meta_description
    * @param 
    * @return boolean 
    */ 
    public function getMetaDescription(){                
        return self::$_meta_description;
    }
    /** 
    * Функция получает meta_keywords страницы
    * Functio get page meta_keywords
    * @param 
    * @return boolean 
    */ 
    public function getMetaKeywords(){                
        return self::$_meta_keywords;
    }
    /** 
    * Функция получает description страницы
    * Functio get page description
    * @param 
    * @return boolean 
    */ 
    public function getDescription(){                
        return self::$_description;
    }
    /** 
    * Функция получает hierarchy страницы
    * Function get page hierarchy
    * @param 
    * @return boolean 
    */ 
    public function getHierarchy(){         
        return self::$_page_arr['hierarchy'];
    }  
    /** 
    * Функция получает алиас страницы
    * Functio get page alias
    * @param 
    * @return boolean 
    */ 
    public function getLandingMenu(){ 
        $landing_menu = "";
        if(isset(self::$_page_arr['alias_page'])){
            $landing_menu = "skins/tpl/nav/".self::$_page_arr['alias_page'].".tpl";
        }
        else{
            $landing_menu = "skins/tpl/nav/empty_menu.tpl";
        }
        return $landing_menu;
    }
    /** 
    * Функция получает контетнта первого экрана
    * Functio get first window
    * @param 
    * @return string 
    */ 
    public function getOffer(){                
        return self::output_decode(self::$_offer);
    }
    /** 
    * Функция получает контетнта страницы
    * Functio get page content
    * @param 
    * @return string 
    */ 
    public function getContent(){
        return str_replace('/uploads', AS_IMG_PATH.'/uploads', self::output_decode(self::$_content));
    }  
    /** 
    * Функция получает html контетнта страницы
    * Functio get html page content
    * @param 
    * @return string 
    */ 
    public function getContentTpl(){
        $content_tpl_tmp="";
        $content_tpl_file="";
        $content_tpl_file_default=AS_ROOT."content/default.tpl";
        if(!empty(self::$instance_url_path)){
            $route = explode('/', trim(self::$instance_url_path, '/')); 
            $content_tpl_tmp = "content";
            foreach($route as $val) 
            {    
                $content_tpl_tmp.= "/".$val;
            }
            $content_tpl_file = AS_ROOT.strtolower($content_tpl_tmp.".tpl");
            if(file_exists($content_tpl_file)){
                return self::removeBOM($content_tpl_file);
            }
            $content_tpl_tmp.= "/default.tpl";
            $content_tpl_file = AS_ROOT.strtolower($content_tpl_tmp);
            if(file_exists($content_tpl_file)){
                return self::removeBOM($content_tpl_file);
            }
            else{
                return $content_tpl_file_default;
                //self::routeErrorPage404();
                //throw new ExceptionFiles("Файл contenet tpl(".$content_tpl_file.") не найден");
                
            }            
        }
        else{
            throw new ExceptionFiles("Пустой url_path");
        }
    }  
    /** 
    * Функция получает шаблон страницы
    * Functio get page tpl
    * @param 
    * @return boolean 
    */ 
    public function getController(){                
        return self::$_controller;
    }  
    /** 
    * Функция получает шаблон страницы
    * Functio get page tpl
    * @param 
    * @return boolean 
    */ 
    static public function getId(){      
        if(!empty(self::$_page_arr)){
            return self::$_page_arr['id'];
        }
        else{
            self::$instance = new Page($url_path);
            return self::$_page_arr['id'];
        }        
    }  
    /** 
    * Функция получает canonical url страницы
    * Functio get page canonical url
    * @param 
    * @return boolean 
    */ 
    static public function getCanonicalUrl(){                
        return self::$_canonical_url;
    } 
    /** 
    * Функция получает массив данных страницы
    * Functio get page array
    * @param 
    * @return boolean 
    */ 
    static public function getPageArray(){                
        return self::$_page_arr;
    } 
    /** 
    * Функция получения верхнего меню
    * Functio get header menu
    * @param 
    * @return string 
    */ 
    static public function getHederMenu(){ 
        if ( empty(self::$_header_menu)){
            self::getMainMenu(self::$instance_url_path);        
        }
        return self::$_header_menu;
    } 
    /* 
    * Функция получения массива меню 
    * Function get menu array
    * @return boolean 
    */ 
    static public function getMenuArr(){        
        try{        
            $res =  DB::mysqliQuery(AS_DATABASE, "
                SELECT 
                    `id`, `url_path`, `name`, `hierarchy`, `parent_id`, `top_menu_set`, `left_menu_set`
                FROM 
                    `". AS_DBPREFIX ."content`     
                ORDER BY `hierarchy`
                    "                     
            );        
        }
        catch (ExceptionDataBase $edb){
            throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
        } 
        $menu_array = array();
        if($res->num_rows>0){            
            while($row = $res->fetch_assoc()) // попутно обрабатывая функцией htmlChars() 
            {  
               $menu_array[$row['id']]=$row;
            }            
        } 
        self::$_menu_arr = $menu_array;        
        return self::$_menu_arr;
    }
    /* 
    * Рекурсивная функция получения дерева меню (Tommy Lacroix)
    * Recursion function get menu tree (Tommy Lacroix)  
    * @param 
    * @return boolean 
    */ 
    static public function getMenuTree(){  
        if(empty(self::$_menu_arr))            self::getMenuArr ();
        $menu_array = self::$_menu_arr;
	$menu_tree = array();
	foreach ($menu_array as $id => &$node) {    
            //Если нет вложений
            if (!$node['parent_id']){
                    $menu_tree[$node['hierarchy'].'_'.$id] = &$node;
            }else{ 
                //Если есть потомки то перебераем массив
                $menu_array[$node['parent_id']]['childs'][$node['hierarchy'].'_'.$id] = &$node;
            }
	}
        // сортируем массив по возрастанию
        ksort($menu_tree);
        //krsort($menu_tree);
        self::$_menu_tree = $menu_tree;
	return self::$_menu_tree;
    }
    /* 
    * Функция получения массива меню 
    * Function get menu array
    * @return boolean 
    */ 
    static public function getCatalogMenuArr(){        
        try{        
            $res =  DB::mysqliQuery(AS_DATABASE, "
                SELECT 
                    `id`, `url_path`, `name`, `hierarchy`, `parent_id`, `menu_hidden_set`
                FROM 
                    `". AS_DBPREFIX ."catalog` 
                ORDER BY `hierarchy`
                    " 
                    
            );        
        }
        catch (ExceptionDataBase $edb){
            throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
        } 
        $menu_array = array();
        if($res->num_rows>0){            
            while($row = $res->fetch_assoc()) // попутно обрабатывая функцией htmlChars() 
            {  
               $menu_array[$row['id']]=$row;
            }            
        } 
        self::$_catalog_menu_arr = $menu_array;
        return self::$_catalog_menu_arr;
    }
    /* 
    * Рекурсивная функция получения дерева меню для каталога(Tommy Lacroix)
    * Recursion function get menu tree for catalog(Tommy Lacroix)  
    * @param 
    * @return boolean 
    */ 
    static public function getCatalogMenuTree(){  
        if(empty(self::$_catalog_menu_arr))            self::getCatalogMenuArr ();
        $menu_array = self::$_catalog_menu_arr;
	$menu_tree = array();
	foreach ($menu_array as $id => &$node) {    
            //Если нет вложений
            if (!$node['parent_id']){
                    $menu_tree[$node['hierarchy'].'_'.$id] = &$node;
            }else{ 
                //Если есть потомки то перебераем массив
                $menu_array[$node['parent_id']]['childs'][$node['hierarchy'].'_'.$id] = &$node;
            }
	}
        // сортируем массив по возрастанию
        ksort($menu_tree);
        //krsort($menu_tree);
        self::$_catalog_menu_tree = $menu_tree;
	return self::$_catalog_menu_tree;
    }
    //Шаблон для вывода меню в виде дерева
    /* 
    * Функция получения html шаблона элемента меню
    * Function get tpl jf item menu  
    * @param array $node
    * @return string 
    */ 
    static public function  getTplMenuItem($node){
        $menu_item = '<li>
                <a href="/'.$node['url_path'].'" title="'. $node['name'] .'" class="dropdown">'.$node['name'].'</a>
                '.self::getTplMenuItemDropdawn($node).'
                </li>';
        return $menu_item;
    }
    /* 
    * Функция получения html шаблона выпадающего элемента меню
    * Function get tpl jf item menu  
    * @param array $node
    * @return string 
    */ 
    static public function  getTplMenuItemDropdawn($node){
        $menu_item ='';
        if(isset($node['childs'])){
            $menu_item = '<ul class="dropdownmenu">';
            foreach ($node['childs'] as $key => $value) {
                $menu_item.= '<a href="/'.$value['url_path'].'" title="'. $value['name'] .'">'.$value['name'].'</a>';
            }
            $menu_item.= '</ul>';
        }
        return $menu_item;
    }
    
    /* 
    * Функция создания верхнего меню 
    * Function to create header menu  
    * @param 
    * @return string 
    */ 
    public function getTopMenu(){
        if(empty(self::$_menu_tree))            self::getMenuTree ();
        $header_menu = '<ul class="container">';
        foreach(self::$_menu_tree as $node){
            if($node['top_menu_set']==1){
		$header_menu .= self::getTplMenuItem($node);
            }
	}
        $header_menu.= '</ul>';
        return $header_menu;
    }
    /* 
    * Функция создания левого меню 
    * Function to create left menu  
    * @param 
    * @return string 
    */ 
    public function getLeftMenu(){
        if(empty(self::$_menu_tree))            self::getMenuTree ();
        $header_menu = '<ul>';
        foreach(self::$_menu_tree as $node){            
            if($node['left_menu_set']==1){
		$header_menu .= self::getTplMenuItem($node);
            }
	}
        $header_menu.= '</ul>';
        return $header_menu;
    }
    /* 
    * Функция создания меню каталога 
    * Function to create catalog menu  
    * @param 
    * @return string 
    */ 
    public function getCatalogMenu(){
        if(empty(self::$_catalog_menu_tree))            self::getCatalogMenuTree();
        $header_menu = '<ul>';
        foreach(self::$_catalog_menu_tree as $node){
            if($node['menu_hidden_set']!==1){
		$header_menu .= self::getTplMenuItem($node);
            }
	}
        $header_menu.= '</ul>';
        return $header_menu;
    }
    /* 
    * Функция получения хлебных крошек
    * Function get breadcrumbs  
    * @param 
    * @return boolean 
    */ 
    public function getBreadCrumbs(){  
        if(empty(self::$_menu_arr))            self::getMenuArr ();
        $menu_array = self::$_menu_arr;
	$bred_crumbs = self::getBreadCrumbsArray($menu_array, self::getId());
        //dbg($bred_crumbs);
	return $bred_crumbs;
    }
    /* 
    * Рекурсивная функция получения 
    * Function get breadcrumbs  
    * @param 
    * @return boolean 
    */ 
    static public function getBreadCrumbsArray($menu_array, $page_id, $active=1){
        $node = $menu_array[$page_id]; 
        if($node['parent_id'] == 0){            
            $bread_crumbs_tpl= '<a href="/">Главная</a><span class="arrow">&raquo;</span><span>'.$node['name'].'</span>'; ;
                        
        } 
        else{
            if($active){
                $bread_crumbs_tpl = self::getBreadCrumbsArray($menu_array, $node['parent_id'], 0).'<span class="arrow">&raquo;</span><span>'.$node['name'].'</span>'; 
            }
            else{
                $bread_crumbs_tpl = self::getBreadCrumbsArray($menu_array, $node['parent_id'], 0).'<span class="arrow">&raquo;</span><a href="/'.$node['url_path'].'">'.$node['name'].'</a>';    
            }            
        }
        //dbg($bread_crumbs_tpl);
        return $bread_crumbs_tpl;
    }
    /* 
    * Функция создания под меню админки
    * Function to create sub menu  
    * @param int $parent_id
    * @return string 
    */ 
    static public function getSubMenu($parent_id= 0){
        $submenu="";      
        try{        
            $res =  DB::mysqliQuery(AS_DATABASE, "
                SELECT 
                    `url_path`, `name`
                FROM 
                    `". AS_DBPREFIX ."content` 
                WHERE 
                    `parent_id`=".$parent_id." AND `show_in_menu`=1
                "
            );        
        }
        catch (ExceptionDataBase $edb){
            throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
        }     
        if($res->num_rows>0){
            $submenu.="<ul class='dropdown-menu c-menu-type-classic c-pull-left'>";
            while($row = $res->fetch_assoc())
            {                    
                $submenu.="                    
                <li><a href='/".$row['url_path']."'>".$row['menu_text']."</a></li>\n\t";               
            }
            $submenu.="</ul>";
        }   
        return $submenu;
    }
    /**  
    * Function of processing of variables for a conclusion in a stream  
    * Функция обработки переменных для вывода в поток   
    */                                                      
    public static function output_decode($data)     
    {     
        if(is_array($data))  // Если данные - массив, вызываем эту же функцию.           
            $data = array_map("output_decode", $data);   
        else  // Если нет, обрабатываем  htmlspecialchars()             
            $data = htmlspecialchars_decode($data);                               
        return $data;  
    }
    /**
     * Function delete BOM 
     * Функция удаления BOM из строки
     * @param string $str - исходная строка
     * @return string $str - строка без BOM
     */
    public static function removeBOM($str="") {
        if(substr($str, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
            $str = substr($str, 3);
        }
        return $str;
    }
}