<?php
class mainclass
{
	public function __construct()
	{
		$this->postget();
	}

	public function verifyEmail($toemail, $fromemail, $getdetails = false)
	{
		return 'ok';
		// $email_arr = explode('@', $toemail);
		// $domain = array_slice($email_arr, -1);
		// $domain = $domain[0];

		// $domain = ltrim($domain, '[');
		// $domain = rtrim($domain, ']');

		// if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
		// 	$domain = substr($domain, strlen('IPv6') + 1);
		// }

		// $mxhosts = array();
		// if (filter_var($domain, FILTER_VALIDATE_IP)) {
		// 	$mx_ip = $domain;
		// } else {
		// 	getmxrr($domain, $mxhosts, $mxweight);
		// }

		// if (!empty($mxhosts)) {
		// 	$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
		// } else {
		// 	if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
		// 		$record_a = dns_get_record($domain, DNS_A);
		// 	} elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
		// 		$record_a = dns_get_record($domain, DNS_AAAA);
		// 	}

		// 	if (!empty($record_a)) {
		// 		$mx_ip = $record_a[0]['ip'];
		// 	} else {
		// 		$result = 'invalid';
		// 		$details .= 'No suitable MX records found.';

		// 		return ((true == $getdetails) ? array($result, $details) : $result);
		// 	}
		// }

		// $connect = @fsockopen($mx_ip, 25);

		// if ($connect) {

		// 	if (preg_match('/^220/i', $out = fgets($connect, 1024))) {

		// 		fputs($connect, "HELO $mx_ip\r\n");
		// 		$out = fgets($connect, 1024);
		// 		$details .= $out."\n";

		// 		fputs($connect, "MAIL FROM: <$fromemail>\r\n");
		// 		$from = fgets($connect, 1024);
		// 		$details .= $from."\n";

		// 		fputs($connect, "RCPT TO: <$toemail>\r\n");
		// 		$to = fgets($connect, 1024);
		// 		$details .= $to."\n";

		// 		fputs($connect, 'QUIT');
		// 		fclose($connect);

		// 		if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
		// 			$result = 'invalid';
		// 		} else {
		// 			$result = 'valid';
		// 		}
		// 	}
		// } else {
		// 	$result = 'invalid';
		// 	$details .= 'Could not connect to server';
		// }
		// if ($getdetails) {
		// 	return array($result, $details);
		// } else {
		// 	return $result;
		// }
	}

	function thai_date($time,$format="2"){

		$thai_month_arr_short=array(
			"0"=>"",
			"01"=>"ม.ค.&nbsp",
			"02"=>"ก.พ.&nbsp",
			"03"=>"มี.ค.&nbsp",
			"04"=>"เม.ย.&nbsp",
			"05"=>"พ.ค.&nbsp",
			"06"=>"มิ.ย.&nbsp",
			"07"=>"ก.ค.&nbsp",
			"08"=>"ส.ค.&nbsp",
			"09"=>"ก.ย.&nbsp",
			"10"=>"ต.ค.&nbsp",
			"11"=>"พ.ย.&nbsp",
			"12"=>"ธ.ค.&nbsp"
		);

		$date=date_create($time);
		$now=date("Y-m-d");
		$time_=date_format($date,'Y-m-d');

		if($time != '0000-00-00 00:00:00'){

			if($format=='1'){


				if($now==$time_){

					$thai_date_return = 'วันนี้ '.date_format($date,"H:i:s");

				}else{

					$thai_date_return = date_format($date,'d');
					$thai_date_return.="&nbsp;".$thai_month_arr_short[date_format($date,'m')];
					$thai_date_return.= " ".date_format($date,'Y')+543;
					$thai_date_return.= " ".date_format($date,"H:i:s");

				}


			}else if($format=='2'){

				if($now==$time_){

					$thai_date_return = 'วันนี้ '.date_format($date,"H:i:s");

				}else{

					$thai_date_return = date_format($date,'d');
					$thai_date_return.="&nbsp;".$thai_month_arr_short[date_format($date,'m')];
					$thai_date_return.= " ".date_format($date,'Y')+543;
					$thai_date_return.= " ".date_format($date,"H:i:s");

				}


			}else if($format=='3'){

				if($now==$time_){

					$thai_date_return = 'วันนี้ '.date_format($date,"H:i:s");;

				}else{

					$thai_date_return = date_format($date,'d');
					$thai_date_return.="&nbsp;".$thai_month_arr_short[date_format($date,'m')];
					$thai_date_return.= " ".date_format($date,'Y');
					$thai_date_return.= " ".date_format($date,"H:i:s");

				}


			}else if($format=='4'){


				$thai_date_return = date_format($date,'d');
				$thai_date_return.="&nbsp;".$thai_month_arr_short[date_format($date,'m')];
				$thai_date_return.= " ".date_format($date,'Y')+543;


			}else{

				$thai_date_return = date_format($date,'d');
				$thai_date_return.="&nbsp;&nbsp;".$thai_month_arr_short[date_format($date,'m')];
				$thai_date_return.= " ".date_format($date,'Y')+543;
				$thai_date_return.= " ".date_format($date,"H:i:s");

			}



			return $thai_date_return;

		}else{

			return 'ยังไม่ระบุ';

		}
	}


	function encrypt($pure_string, $encryption_key='') {
		$encrypted_string =  base64_encode($encryption_key.'|'.base64_encode(utf8_encode($pure_string)));
		return $encrypted_string;
	}

	function decrypt($encrypted_string, $encryption_key='') {
		$decrypted_string = utf8_decode(base64_decode(str_replace($encryption_key.'|', '', base64_decode($encrypted_string))));
		return $decrypted_string;
	}

	function ago($datetime_string,$full=false) {
		date_default_timezone_set('Asia/Bangkok');
		$ts = strtotime($datetime_string);
		$now = strtotime('now');
		if(!$ts || $ts > $now) {
			return false;
		}

		$diff = $now - $ts;
		$second = 1;
		$minute = 60 * $second;
		$hour = 60 * $minute;
		$day = 24 * $hour;
		$yesterday = 48 * $hour;
		$month = 30 * $day;
		$year = 365 * $day;
		$ago = "";

		if($diff >= $year) {
			$full = ($full == true) ? " ปี ที่แล้ว" : " ป";
			$ago = round($diff/$year) . $full;
		}else if($diff >= $month) {
			$full = ($full == true) ? " เดือน ที่แล้ว" : " ด";
			$ago = round($diff/$month) . $full;
		}else if($diff > $yesterday) {
			$full = ($full == true) ? " วัน ที่แล้ว" : " ว";
			$ago = intval($diff/$day) . $full;
		}else if($diff <= $yesterday && $diff > $day) {
			$ago = ($full == true) ? " เมื่อวาน" : "1 ว";
		}else if($diff >= $hour) {
			$full = ($full == true) ? " ชั่วโมง ที่แล้ว" : " ช";
			$ago = intval($diff/$hour) . $full;
		}else if($diff >= $minute) {
			$full = ($full == true) ? " นาที ที่แล้ว" : " น";
			$ago = intval($diff/$minute) . $full;
		}else {
			$ago = "สักครู่";
		}
		return $ago;
	}

	function substr_utf8( $str, $start_p , $len_p){
		return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.
			'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s',
			'$1' , $str );
	}

	function datetime($time){
		$date=date_create("$time");
		$year=date_format($date,"Y")+543;
		return date_format($date,"d/m/$year H:i:s");
	}

	function dateday($time){
		$date=date_create("$time");
		$year=date_format($date,"Y")+543;
		return date_format($date,"d/m/$year");
	}

	public function trimurl($name='')
	{
		return str_replace(array(' ','/',',',':','+','(',')','*'),array('-','-','-','','','','',''),strtolower(trim($this->remove_accent($name))));
	}

	function ec($data='',$html='')
	{
		if($html == '1'){
			return $this->rmrn($this->xss_clean($data));
		}else{
			return $this->mysql_escape_mimic($this->rmrn($this->xss_clean(strip_tags($data))));
		}
	}
	function xss_clean($data)
	{
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		// $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do
		{
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);

		return $data;
	}
	function rmrn($value='')
	{
		return $this->remove_accent($this->remove_style($value));
	}
	function remove_accent($str)
	{
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ','(',')','*','\'','&','%');
		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','','','','','-','');
		return str_replace($a, $b, $str);
	}
	function mysql_escape_mimic($inp) {
		if(is_array($inp))
			return array_map(__METHOD__, $inp);

		if(!empty($inp) && is_string($inp)) {
			return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
		}
		return $inp;
	}
	function remove_style($html='')
	{
		$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
		$html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
		$html = str_replace("<script", '<span', $html);
		$html = str_replace("</script", '</span', $html);
		$html = str_replace("<style", '<span', $html);
		$html = str_replace("</style", '</span', $html);
		return $html;
	}

	function format_number_k($number) {
		if($number >= 1000) {
			$nb = ($number/1000);
			return round($nb,1).'k';
		}else {
			return $number;
		}
	}

	function getAge($birthday) {
		$then = strtotime($birthday);
		return(floor((time()-$then)/31556926));
	}

	function token($value='') {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 16; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		$pass = implode($pass);
		return md5($pass.$value.hash('ripemd160',$pass));
	}

	public function createUploadDirectories($upload_path=null){
		if($upload_path==null) return false;
		$upload_directories = explode('/',$upload_path);
		$createDirectory = array();
		foreach ($upload_directories as $upload_directory){
			$createDirectory[] = $upload_directory;
			$createDirectoryPath = implode('/',$createDirectory);
			if(!is_dir($createDirectoryPath)){
				$old = umask(0);
				mkdir($createDirectoryPath,0777);
				umask($old);
			}
		}
		return true;
	}

	function postget()
	{
		if(isset($_POST) && count($_POST) != 0){
			foreach ($_POST as $key => $data) {
				$_POST[$key] = $this->ec($data,'1');
			}
		}
		if(isset($_GET)  && count($_GET) != 0){
			foreach ($_GET as $key => $data) {
				$_GET[$key] = $this->ec($data);
			}
		}
	}

	function discount($ProductSprice='',$ProductPrice='')
	{
		if($ProductSprice <= $ProductPrice){
			return 0;
		}else{
			$discount=$ProductSprice-$ProductPrice;
			$discount=$discount/$ProductSprice;
			$discount=$discount*100;
			$discount=round($discount);
			return $discount;
		}
	}

	public function sendmail($mail='',$Subject='',$messages='',$toemail='',$name='')
	{
		$mail->FromName = SEND_EMAIL_FROM_NAME;
		$mail->Subject = $Subject;

		$mail->Body = $messages;

		$mail->AddAddress($toemail,$name);
		$mail->AddCC(SEND_EMAIL_CC,SEND_EMAIL_FROM_NAME);
		$mail->set('X-Priority', '1');
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent Lang '._LANG_;
		}
		$mail->SmtpClose();
	}

	public function ismobile()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		{
			return true;
		}else{
			return false;
		}
	}

	public function pricetotext($number){
		$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
		$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
		$number = str_replace(",","",$number);
		$number = str_replace(" ","",$number);
		$number = str_replace("บาท","",$number);
		$number = explode(".",$number);
		if(sizeof($number)>2){
			return 'ทศนิยมหลายตัวนะจ๊ะ';
			exit;
		}
		$strlen = strlen($number[0]);
		$convert = '';
		for($i=0;$i<$strlen;$i++){
			$n = substr($number[0], $i,1);
			if($n!=0){
				if($i==($strlen-1) AND $n==1){
					$convert .= 'เอ็ด';
				}elseif($i==($strlen-2) AND $n==2){
					$convert .= 'ยี่';
				}elseif($i==($strlen-2) AND $n==1){
					$convert .= '';
				}else{
					$convert .= $txtnum1[$n];
				}
				$convert .= $txtnum2[$strlen-$i-1];
			}
		}

		$convert .= 'บาท';
		if(@$number[1]=='0' OR @$number[1]=='00' OR @$number[1]==''){
			$convert .= 'ถ้วน';
		}else{
			$strlen = strlen($number[1]);
			for($i=0;$i<$strlen;$i++){
				$n = substr($number[1], $i,1);
				if($n!=0){
					if($i==($strlen-1) AND $n==1){
						$convert.= 'เอ็ด';
					}elseif($i==($strlen-2) AND $n==2){
						$convert .= 'ยี่';
					}elseif($i==($strlen-2) AND $n==1){
						$convert .= '';
					}else{
						$convert .= $txtnum1[$n];
					}
					$convert .= $txtnum2[$strlen-$i-1];
				}
			}
			$convert .= 'สตางค์';
		}
		return $convert;
	}

	function genkey($length = 6,$number=false) {
		$str = "";
		if($number == false){
			$characters = array_merge(range('A','Z'), range('0','9'));
		}else{
			$characters = array_merge(range('0','9'));
		}
		// $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	public function url_clean($name='')
	{
		$url = strtolower(trim(preg_replace('/\s+/', '-',preg_replace('/\s\s+/', '-', preg_replace("/[^a-z0-9ก-ฮเ-์_-]/i", " ", strip_tags($name)))), '-'));
		return $url;
	}

	function format_date($time,$format="0",$lg="th"){
		if(_LANG_DIGI_ != ''){
			$lg = _LANG_DIGI_;
		}

		if($lg == 'th'){
			$thai_month_arr_short=array(
				"0"=>"",
				"01"=>"ม.ค. ",
				"02"=>"ก.พ. ",
				"03"=>"มี.ค. ",
				"04"=>"เม.ย. ",
				"05"=>"พ.ค. ",
				"06"=>"มิ.ย. ",
				"07"=>"ก.ค. ",
				"08"=>"ส.ค. ",
				"09"=>"ก.ย. ",
				"10"=>"ต.ค. ",
				"11"=>"พ.ย. ",
				"12"=>"ธ.ค. "
			);
		}else{
			$thai_month_arr_short=array(
				'0'=>'',
				'01'=>'Jan ',
				'02'=>'Feb ',
				'03'=>'Mar ',
				'04'=>'Apr ',
				'05'=>'May ',
				'06'=>'Jun ',
				'07'=>'Jul ',
				'08'=>'Aug ',
				'09'=>'Sep ',
				'10'=>'Oct ',
				'11'=>'Nov ',
				'12'=>'Dec '
			);
		}


		$date=date_create($time);

		if($time != '0000-00-00 00:00:00'){



			$thai_date_return = date_format($date,'d');
			$thai_date_return.=" ".$thai_month_arr_short[date_format($date,'m')];
			if($lg == 'th'){
				$thai_date_return.= " ".date_format($date,'Y')+543;
			}else{
				$thai_date_return.= " ".date_format($date,'Y');
			}

			if($format=='1'){
				$thai_date_return.= " ".date_format($date,"H:i:s");

			}

			return $thai_date_return;

		}else{

			return 'ยังไม่ระบุ';

		}
	}

	public function getip() {
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
}
?>