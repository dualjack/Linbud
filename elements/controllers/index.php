<?php

/*	To jest plik z podstawowymi funkcjami potrzebnymi do funkcjonowania strony.
 * 	$db to obiekt połączenia MySQL metodą PDO.
 */

class site {

	function __construct(){
		ob_start();
		session_start(); // Rozpocznij sesję
	}
	
	function end(){
		
		echo self::$page_title;
		
		ob_end_flush(); // zakończ buferowanie
		
		// Ustaw ostatnią stronę w sesji, jako aktualną
		$_SESSION['last'] = $_SERVER['REQUEST_URI'];

	}
	
	static function back( $notify = NULL ){
		if(isset($_SESSION['last'])){ // Jeśli była poprzednia strona
			$url = $_SESSION['last'];
		} else { $url = "/"; } // Jeśli nie była określona
		
		if(isset($notify)) $_SESSION['nf'] = $notify;
		
		header("Location: {$url}");
	}
	
	static function notification(){
		if(isset($_SESSION['nf'])) { // Jeśli w sesji jest notyfikacja

			$nf = explode('|',$_SESSION['nf']); // np. powiadomienie|green
			
			if(isset($nf[1])) {
				
				if($nf[1]=='green') $nf[1] = '#36C014';
				if($nf[1]=='red') $nf[1] = '#F34747';
				if($nf[1]=='yellow') $nf[1] = '#F0E175';
				
				 $style = 'color:'.$nf[1];
				 
			 } else {
				 
				 $style = NULL;
				 
			 }
			
			echo '<div class="notify-wrapper"><div class="notify rounded-5px" style="'.$style.'">'.$nf[0].'</div></div>';
			
			unset($_SESSION['nf']);
		}
	}
	
	# domyslny tytuł strony
	static $page_title = "LINBUD - Strona Główna";
	# ---
	
	static function page_title($title){
		
		// zmodyfikuj domyslną nazwę w obiekcie
		self::$page_title = $title;
	}
	
	static function errors(){
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	
	##--- domyślna główna strona
	static public $default_url = "main";
	
	static function url($x){
		
		// jeśli jest jakiś adres w formie /x/y/z
		if(isset($_GET['url'])){
			$url = explode('/' , $_GET['url']);
		} else {
			$url[0] = self::$default_url;
		}
		
		// jeśli istnieje taka część adresu
		if(isset($url[$x])) return $url[$x];
	}
	
	function load_controller($id){
		
		// - ładowanie kontrolerów
		$controller = 'elements/controllers/'.$id.'.php';
		if(file_exists($controller)) include $controller;
	}
	
	function load_page($id){
		
		// - ładowanie kontekstu
		$content = 'elements/pages/'.$id.'.php';
		if(file_exists($content)) include $content;
		else self::error(404);
	}
	
	static function error($error_type) {
		
		header("Location: /{$error_type}");
		
	}
	
}


class mysql {
	
	#---
	public static $host="localhost";
	public static $user="root";
	public static $pass="Mocher94";
	public static $dbname="test";
	
	public static $db; // nośnik z połączeniem
	#---
	
	static function db_connect(){
		
		### połączaenie z bazą danych - MySQL
		$db=new PDO('mysql:host='.self::$host.';dbname='.self::$dbname,self::$user,self::$pass);
		$db->query("SET NAMES utf8");
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		### ---
		
		mysql::$db = $db;
		
	}
	
	static function db(){
		return mysql::$db;
	}
	
	static function create_tables(){
		
		// Stwórz tabelę kategorii wpisów na blogu
		$query = "CREATE TABLE IF NOT EXISTS categories (
		cat_id int(2) NOT NULL auto_increment,
		cat_title varchar(50) NOT NULL,
		cat_desc varchar(200) NOT NULL,
		cat_color varchar(7) NOT NULL,
		PRIMARY KEY(cat_id))
		";
		self::db()->query($query);
	}
}

class visible {
	
	static function set_default_access(){
		
		// zdefiniuj domyślną wartość autoryzacji
		if(!isset($_SESSION['admin_auth'])) $_SESSION['admin_auth'] = FALSE;
	}
	
	// np. $obiekt->admin("Tego nie zobaczy gość");
	static function admin($html){
		if($_SESSION['admin_auth'] == TRUE)
		{
			echo $html;
		}
	}
		
	static function guest($html){
		if($_SESSION['admin_auth'] == FALSE)
		{
			echo $html;
		}
	}
	
}



?>
