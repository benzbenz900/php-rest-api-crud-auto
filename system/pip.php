<?php
class run{

	function __construct($this_)
	{
		// if($this->segment(1) != 'admin' && $this->segment(1) != 'api' && $this->segment(2) != 'invoice' && $this->segment(1) != 'product' && $this->segment(1) != 'promotion' && $this->segment(1) != 'login' && $this->segment(1) != 'booking'){
		// 	ob_start('sanitize_output');
		// }
		$this->$this_();

	}

	function segment($seg)
	{
		if(!is_int($seg)) return false;
		$parts = explode('/', $_SERVER['REQUEST_URI']);
		return isset($parts[$seg]) ? $parts[$seg] : false;
	}

	public function pip()
	{
		global $config;
		$controller = $config['default_controller'];
		$action = 'index';
		$url = '';

		$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
		$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

		if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');

		$segments = explode('/', $url);
		$segment[0] = explode('-',$segments[0]);
		// if (isset($segment[0][0]) && strstr($segment[0][0],"detail")) {
		// 	$controller = 'detail';
		// }else{
			if(isset($segments[0]) &&  $segments[0] != ''){
				$controller = $segments[0];
			}
		// }

		if(isset($segments[0]) && strstr($segments[0],"?ref=")){
			$controller = 'main';
			if(isset($segments[0]) && $segments[0] != '') $action = 'index';
		}elseif(isset($segments[1]) && strstr($segments[1],"?")){
			if(isset($segments[1]) && $segments[1] != '') $action = 'index';
		}elseif (isset($segments[0]) && strstr($segments[0],"-")) {
			$segments[1] = explode('-',$segments[0]);
			if(isset($segments[1]) && is_numeric($segments[1])) $action = 'index';
			$segments[2] = $segments[1][1];
			$segments[3] = implode('-',array_slice($segments[1],2));
		}elseif (isset($segments[0]) && strstr($segments[0],"store")) {
			if($segments[1] != 'all'){
				$action = 'index';
				if(isset($segments[2])){
					$segments[3] = $segments[2];
				}
				$segments[2] = $segments[1];
			}else{
				if(isset($segments[1]) && $segments[1] != '') $action = 'all';
			}
		}else{
			if(isset($segments[1]) && $segments[1] != '') $action = $segments[1];
		}

		$path = APP_DIR . 'controllers/' . $controller . '.php';
		if(file_exists($path)){
			require_once($path);
		} else {
			$controller = $config['error_controller'];
			require_once(APP_DIR . 'controllers/' . $controller . '.php');
		}

		if(!method_exists($controller, $action)){
			$controller = $config['error_controller'];
			require_once(APP_DIR . 'controllers/' . $controller . '.php');
			$action = 'index';
		}

		$obj = new $controller;
		die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
	}



}
?>