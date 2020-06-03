<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class api extends Controller {
	private $database;
	private $db;
	private $mainclass;
	public $resData = array('status'=>true,'data'=>false);
	function __construct()
	{

		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
		
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
		
			exit(0);
		}
		
		$this->database = $this->loadModel('database');
		$this->db = $this->database;
		$this->mainclass = $this->loadModel('mainclass');

		$this->database->no_cache(true);

		$this->where = (isset($_GET['where'])) ? str_replace(
			array(';eq;',';neq;',';and;',';or;',';0;',';00;',';like;',';ap;',';moreeq;',';lesseq;',';sin;',';ein;',';nlike;',';more;',';less;',';rlike;',';nrlike;'),
			array('` = \'','` != \'','\' and `','\' or `','null','','` LIKE \'','%','`>=\'','`<=\'','` IN (',')','` NOT LIKE \'','`>\'','`<\'','` RLIKE \'','` NOT RLIKE \''),
			'`'.$_GET['where'].'\'') : '';

		$this->in = (isset($_GET['in'])) ? str_replace(
			array(';sin;',';ein;'),
			array('` IN (',')'),
			'`'.$_GET['in'].'') : '';

		$this->where = (isset($_GET['in'])) ?  ($this->where == '') ? $this->in : $this->where.' AND '.$this->in : $this->where;
		$this->value = (isset($_GET['value'])) ?  $_GET['value'] : '*';

		$this->limit = (isset($_GET['limit'])) ? $_GET['limit'] : 'all';
		$this->order = (isset($_GET['order'])) ? str_replace(array(';desc',';asc',';rand'),array(' DESC',' ASC','RAND()'),$_GET['order']) : '';

		$this->match = (isset($_GET['match'])) ? $_GET['match'] : '';
		$this->lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'th';

		$this->group_by = (isset($_GET['group'])) ? $_GET['group'] : '';

	}
	public function index($value='')
	{
		$t = $this->loadView('app/doc');
		$t->set('title','lnwPHP By cii3.net | PIP');
		$t->set('actual_link','api/v1');

		$tablell = $this->getlistname($this->database);
		foreach ($tablell as $key => $value) {
			foreach($value as $k => $value_arr){
				$api[$value_arr] = $this->getname($this->database,$value_arr);
				$value_api[$value_arr] = $this->getfull($this->database,$value_arr)['0']->TABLE_COMMENT;
			}
		}
		$t->set('value_api',$value_api);
		$t->set('api',$api);
		$t->render();
	}
	
	
function v1($table='',$find='',$finds=''){
	if ($table != ''){
		if($table == 'raw'){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				eval("\$data = \$this->raw(\$this->database,base64_decode(\$find));");
				header("Content-type: application/json; charset=utf-8");
				if($data === null){
					$this->resData['status'] = false;
					echo json_encode($this->resData,JSON_PRETTY_PRINT);
					exit();
				}
				$this->resData['data'] = $data;
				echo json_encode($this->resData,JSON_PRETTY_PRINT);
				exit();
			}else{
				echo "RAW SUPPORT POST";
				exit();
			}
		}else{
			if(strpos($find,"limit")){
				$this->limit = $_GET['limit'];
			}elseif($find != ''){
				if(!isset($_GET['limit'])){
					$this->limit = '';
				}
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$post = $table.'post';
				if(method_exists($this, $post)){
					eval("\$data = \$this->\$post(\$this->database,\$table,\$this->where,\$find,\$finds,\$_POST,\$_FILES);");
				}else{
					eval("\$data = \$this->dpost(\$this->database,\$table,\$this->where,\$find,\$finds,\$_POST,\$_FILES);");
				}
				if($data === false){
					$this->resData['status'] = false;
					echo json_encode($this->resData,JSON_PRETTY_PRINT);
					exit();
				}
				$this->resData['data'] = $data;
				echo json_encode($this->resData,JSON_PRETTY_PRINT);
				exit();
			}else{
				if(method_exists($this, $table)){
					eval("\$data = \$this->\$table(\$this->database,\$table,\$this->where,\$this->limit,\$find,\$finds,\$this->order);");
				}else{
					eval("\$data = \$this->dtables(\$this->database,\$table,\$this->where,\$this->limit,\$find,\$finds,\$this->order);");
				}
				header("Content-type: application/json; charset=utf-8");

				if($data === false){
					$this->resData['status'] = false;
					$this->resData['data'] = array($table=>[]);
					$this->resData['message'] = 'Data '.$table;
					$this->resData['total'] = 0;
					echo json_encode($this->resData,JSON_PRETTY_PRINT);
					exit();
				}

				$this->resData['data'] = array($table=>$data);
				$this->resData['message'] = 'Data '.$table;
				$this->resData['total'] = $this->countAll($this->database,$table,$this->where,$this->limit,$find,$finds,$this->order);
				echo json_encode($this->resData,JSON_PRETTY_PRINT);
				exit();
			}
		}
	}else{
		echo 'Rest V1';
		exit();
	}
}

private function dpost($d='',$table='',$where='',$find='',$finds='',$array = array(),$files = array()){
	if($array != ''){
		if($array['action'] == 'update'){
			$data = $d->table($table)->no_cache()->value($this->value)->where($where)->find_one($find,$finds);
			foreach ($array as $key => $value) {
				if($key != 'action'){
					$data->set($key, strip_tags($value));
				}
			}
			return $data->save();
		}elseif($array['action'] == 'delete'){
			if($array['token'] == TOKEN_ACTION){
				$data = $d->table($table)->no_cache()->value($this->value)->where($where)->del($find,$finds);
				return $data;
			}else{
				return false;
			}
		}elseif($array['action'] == 'add'){
			$data = $d->table($table)->create();
			foreach ($array as $key => $value) {
				if($key != 'action'){
					$data->set($key, strip_tags($value));
				}
			}
			return $data->save();
		}else{
			return false;
		}
	}else{
		return false;
	}
}

private function raw($d='',$sql='')
{
	$data = $d->raw($sql);
	return $data;
}

private function countAll($d='',$table='',$where='',$limit='',$find='',$finds='',$order=''){
	return @$d->table($table)->no_cache()->count()->value('')->where($where)->order_by($order)->find_one()->total;
}

private function dtables($d='',$table='',$where='',$limit='',$find='',$finds='',$order=''){
	if($limit == 'all'){
		$data = @$d->table($table)->no_cache()->value($this->value)->where($where)->order_by($order)->group_by($this->group_by)->find_all();
	}else{
		$data = @$d->table($table)->no_cache()->value($this->value)->where($where)->limit($limit)->group_by($this->group_by)->order_by($order)->find($find,$finds);
	}
	return $data;
}

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

public function getname($d='',$table='')
{
	$data = $d->raw("SHOW FULL COLUMNS FROM `$table`;");
	return $data;
}

public function getlistname($d=''){
	$data = $d->raw("SHOW TABLES;");
	return $data;
}

public function getfull($d='',$table='')
{
	$data = $d->raw("SELECT TABLE_COMMENT FROM information_schema.TABLES WHERE TABLE_NAME = '".$table."';");
	return $data;
}

}
?>