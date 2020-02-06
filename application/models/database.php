<?php
class database {
	protected $table_db = '';
	protected $value_db = '*';
	protected $where_db = '';
	protected $group_db = '';
	protected $order_db = '';
	protected $save;
	protected $data_set = array();
	protected $add = array();
	protected $limit_db = "LIMIT 10";
	protected $connection;
	protected $count;
	protected $session_key;
	protected $session_secret;
	protected $key_session_page;
	protected $jointable;
	protected $jointable_db;
	protected $value_join;
	public $no_cache = true;
	public $show_sqls = false;
	protected $value_left;
	protected $create = false;
	protected $update = false;


	public function __construct()
	{
		global $config;
		//@session_destroy();
		if($config['token_encode']){
			$this->session_key = md5($config['token_session']);
			$this->session_secret = md5($config['token_pass']);
		}else{
			$this->session_key = $config['token_session'];
			$this->session_secret = $config['token_pass'];
		}
		$this->connection = new mysqli($config['db_host'],$config['db_username'], $config['db_password'], $config['db_name']);
		if ($this->connection->connect_error) {
			die($this->connection->connect_error);
		}
		$this->connection->set_charset("utf8");
		$this->connection->query("SET names utf8");
	}

	public static function table($table_db='')
	{
		$instance = new self();
		$instance->table_db = $table_db;
		return $instance;
	}

	public function no_cache($val=true)
	{
		$this->no_cache = $val;
		return $this;
	}

	public function show_sql($val=false)
	{
		$this->show_sqls = $val;
		return $this;
	}

	public function join($jointable='',$on1='',$on2='')
	{
		$this->jointable_db = $jointable;
		$this->jointable = 'INNER JOIN '.$jointable.' ON `'.$this->table_db.'`.`'.$on1.'` = `'.$jointable.'`.`'.$on2.'`';
		return $this;
	}

	public function joinr($jointable='',$on1='',$on2='')
	{
		$this->jointable_db = $jointable;
		$this->jointable = 'RIGHT JOIN '.$jointable.' ON `'.$this->table_db.'`.`'.$on1.'` = `'.$jointable.'`.`'.$on2.'`';
		return $this;
	}

	public function add($data='',$var='')
	{
		$this->add[$data] = $var;
	}

	public function del($where_db='',$pram='')
	{
		if($where_db != '' && $pram != ''){
			$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
		}
		return $this->query("DELETE FROM `$this->table_db` $this->where_db LIMIT 1;");
	}

	public function del_all($where_db='',$pram='')
	{
		if($where_db != '' && $pram != ''){
			$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
		}
		return $this->query("DELETE FROM `$this->table_db` $this->where_db;");
	}

	public function left($field='',$len='')
	{
		$this->value_left = ',LEFT('.$field.', '.$len.') AS '.$field;
		return $this;
	}

	public function value($value_db='')
	{
		if($value_db == '*' || $value_db == ''){
			$this->value_db = $this->count.$value_db;
		}else{
			$value_db = explode(',', $value_db);
			if($this->show_sqls){
				var_dump($value_db);
			}
			$countt = count($value_db);
			$i=0;
			$join = '';
			foreach ($value_db as $value) {
				$i++;
				if($i == $countt){
					if(strpos($value, ' ') !== false){
						$join .= $value;
					}else{
						$join .= '`'.$this->table_db.'`.`'.$value.'`';
					}
				}else{
					if(strpos($value, ' ') !== false){
						$join .= $value.',';
					}else{
						$join .= '`'.$this->table_db.'`.`'.$value.'`,';
					}
				}
			}
			$this->value_db = $this->count.$join;
		}
		return $this;
	}

	public function value_join($value_join='')
	{
		$value_join = explode(',', $value_join);
		$countt = count($value_join);
		$i=0;
		$join = '';
		foreach ($value_join as $value) {
			$i++;
			if($i == $countt){
				$join .= '`'.$this->jointable_db.'`.`'.$value.'`';
			}else{
				$join .= '`'.$this->jointable_db.'`.`'.$value.'`,';
			}
		}
		$this->value_join = ','.$join;
		return $this;
	}

	public function count()
	{
		$this->count = "COUNT(*) as `total`,";
		return $this;
	}

	public function group_by($group_db='')
	{
		if($group_db != '' || $group_db != null){
			$this->group_db = "GROUP BY ".$group_db." ";
			return $this;
		}
		return $this;
	}

	public function where($where_db='')
	{
		if($where_db != '' || $where_db != null){
			$this->where_db = "WHERE ".$where_db;
			return $this;
		}
		return $this;
	}

	public function where_equal($where_db='',$pram='')
	{
		$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
		return $this;
	}

	public function where_not_equal($where_db='',$pram='')
	{
		$this->where_db = "WHERE `".$where_db."` != '".$pram."'";
		return $this;
	}

	public function order_by($order_db='')
	{
		if($order_db != '' || $order_db != null){
			$this->order_db = "ORDER BY ".$order_db;
			return $this;
		}
		return $this;
	}

	public function order_desc($order_db='')
	{
		if($order_db != '' || $order_db != null){
			$this->order_db = "ORDER BY ".$order_db." DESC";
			return $this;
		}
		return $this;
	}

	public function order_asc($order_db='')
	{
		if($order_db != '' || $order_db != null){
			$this->order_db = "ORDER BY ".$order_db." ASC";
			return $this;
		}
		return $this;
	}

	public function limit($limit_db='')
	{
		if($limit_db != '' || $limit_db != null){
			$this->limit_db = "LIMIT ".$limit_db;
			return $this;
		}
		return $this;
	}

	public function find($where_db='',$pram='')
	{
		if($where_db != '' && $pram != ''){
			$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
		}
		$sql = "SELECT $this->value_db $this->value_join $this->value_left FROM `$this->table_db` $this->jointable $this->where_db $this->group_db $this->order_db $this->limit_db;";
		if($this->show_sqls){
			var_dump($sql);
		}
		if(isset($_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find'])){
			$data = $_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find'];
			if($this->no_cache){
				$_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find'] = null;
				$this->no_cache = false;
			}
		}else{
			$data_query = $this->query($sql);
			if(is_object($data_query)){
				if($data_query->num_rows > 0){
					while ($rows = $data_query->fetch_object()) {
						$data[] = $rows;
					}
					self::query_cache(md5($sql).'_find',$data);
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return $data;
	}

	public function find_one($where_db='',$pram='')
	{
		if($where_db != '' && $pram != ''){
			if($pram != ''){
				$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
			}
		}
		$this->limit_db = "LIMIT 1";
		$sql = "SELECT $this->value_db $this->value_join $this->value_left FROM `$this->table_db` $this->jointable $this->where_db $this->group_db $this->order_db $this->limit_db;";
		if($this->show_sqls){
			var_dump($sql);
		}
		if(isset($_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_one'])){
			$this_ = $_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_one'];
			$this->key_session_page = md5($sql).'_find_one';
			// $this_->set = $this;
			if($this->no_cache){
				$_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_one'] = null;
				$this->no_cache = false;
			}
		}else{
			$data_query = $this->query($sql);
			$this_ = $data_query->fetch_object();
			self::query_cache(md5($sql).'_find_one',$this_);
			$this->key_session_page = md5($sql).'_find_one';
			// $this_->set = $this;
		}
		if($this_){
			foreach($this_ AS $var=>$value){
				$this->$var = $value;
			}
		}
		// $this->update = true;
		// $this = (object) array_merge((array) $this_,(array) $this);
		return $this;
	}

	public function find_all($where_db='',$pram='')
	{
		if($where_db != '' && $pram != ''){
			$this->where_db = "WHERE `".$where_db."` = '".$pram."'";
		}
		$sql = "SELECT $this->value_db $this->value_join $this->value_left FROM `$this->table_db` $this->jointable $this->where_db $this->group_db $this->order_db;";
		if($this->show_sqls){
			var_dump($sql);
		}
		if(isset($_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_all'])){
			$data = $_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_all'];
			if($this->no_cache){
				$_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][md5($sql).'_find_all'] = null;
				$this->no_cache = false;
			}
		}else{
			$data_query = $this->query($sql);
			if($data_query->num_rows > 0){
				while ($rows = $data_query->fetch_object()) {
					$data[] = $rows;
				}
				self::query_cache(md5($sql).'_find_all',$data);
			}else{
				return false;
			}
		}
		return $data;
	}

	public function query_cache($var='',$data='')
	{
		if($this->no_cache == false){
			$_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][$var] = $data;
		}
	}

	public function raw($sql='')
	{
		$data = [];
		$raw = $this->query($sql);
		while ($rows = $raw->fetch_object()) {
			$data[] = $rows;
		}
		return $data;
	}

	public function query($sql='')
	{
		$query = $this->connection->query($sql);
		return $query;
	}

	public function create()
	{
		$this->create = true;
		return $this;
	}

	public function set($val='',$value='')
	{
		if($this->create == true){
			$this->add($val,$value);
		}else{
			$this->data($val,$value);
		}
	}

	public function save()
	{
		if($this->create == true){
			return $this->save_add();
		}else{
			$this->update = true;
			return $this->update();
		}
	}

	public function data($data='',$var='')
	{
		$this->data_set[$data] = $var;
	}

	public function update()
	{
		$data_to_save = '';
		$i = 0;
		foreach ($this->data_set as $key => $value) {
			if($i == count($this->data_set)-1){
				$data_to_save .= "`".$key."` = '".$value."'";
			}else{
				$data_to_save .= "`".$key."` = '".$value."',";
			}
			$i++;
		}
		$_SESSION[$this->session_key][$this->session_secret][md5($this->session_key.$this->session_secret)][$this->key_session_page] = null;
		return $this->query("UPDATE `$this->table_db` SET $data_to_save $this->where_db;");
	}

	public function save_add()
	{
		$data_key = '';
		$data_value = '';
		$i = 0;
		foreach ($this->add as $key => $value) {
			if($i == count($this->add)-1){
				$data_key .= "`".$key."`";
				$data_value .= "'".$value."'";
			}else{
				$data_key .= "`".$key."`,";
				$data_value .= "'".$value."',";
			}
			$i++;
		}
		// echo "INSERT INTO `$this->table_db` ($data_key) VALUES ($data_value);";
		$this->query("INSERT INTO `$this->table_db` ($data_key) VALUES ($data_value);");
		return $this->connection->insert_id;
	}

}
?>
