<?php
class Controller {
	// public static $db;
	public $cache_ext;
	public $cache_time;
	public $cache_folder;
	public $ignore_pages;
	public $dynamic_url;
	public $cache_file;
	public $ignore;
	public $cache_ = false;

	public function __construct(){
		// $this->cache_ext = '_.cache.inc';
		// $this->cache_time = 1800;
		// $this->cache_folder = ROOT_DIR.'static/cache/controller/';
		// $this->ignore_pages = array(
		// 	'',
		// 	''
		// );
		// $this->dynamic_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'];
		// $this->cache_file = $this->cache_folder . md5($this->dynamic_url) . $this->cache_ext;
		// $this->ignore = (in_array($this->dynamic_url,$this->ignore_pages)) ? true : false;
	}

	public function cachepage_start(){
		// ob_start();
		// if(! $this->ignore && file_exists($this->cache_file) && time() - $this->cache_time < filemtime($this->cache_file)){
		// 	ob_start('ob_gzhandler');
		// 	readfile($this->cache_file);
		// 	echo '<!-- cached page - ' . date('l jS \of F Y h:i:s A',filemtime($this->cache_file)) . ', Page : ' . $this->dynamic_url . ' -->';
		// 	ob_end_flush();
		// 	exit();
		// }
		// ob_start('ob_gzhandler');
		// $this->cache_ = true;
	}

	public function cachepage_end(){
		// if($this->cache_){
		// 	if(! is_dir($this->cache_folder)){
		// 		mkdir($this->cache_folder);
		// 	}
		// 	if(! $this->ignore){
		// 		$fp = fopen($this->cache_file,'w');
		// 		fwrite($fp,ob_get_contents());
		// 		fclose($fp);
		// 	}
		// 	ob_end_flush();
		// }
	}

	public function loadModel($name)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	// if (!function_exists('mainclass')) {
	public function mainclass()
	{
		require(APP_DIR .'models/mainclass.php');

		$model = new mainclass;
		return $model;
	}
	// }

	public static function incModel($name)
	{
		require(APP_DIR .'models/'. $name .'.php');
	}

	public function incPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}

	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}

	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}

	public function loadHelper($name)
	{
		if (!class_exists( strtolower($name))) {
			require(APP_DIR .'helpers/'. strtolower($name) .'.php');
			$helper = new $name;
			return $helper;
		}
	}

	public function redirect($loc,$out='0')
	{
		if($out == '0'){
			global $config;
			header('Location: '. $config['base_url'] . $loc);
		}else{
			header('Location: '.$loc);
		}
	}

}

?>