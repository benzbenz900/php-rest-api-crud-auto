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

	public function menu_cate_left($database){
		$cate = '';
		if(_LANG_DIGI_=='en' || _LANG_DIGI_=='cn'){
			$CateRand = $database->table('categorys')->value('id,name,name_en,imageindex,imageindex_en,bgcolor')->where('`show_hidden` = \'1\' AND `parentid` = \'0\'')->order_asc('name_en')->find();
		}else{
			$CateRand = $database->table('categorys')->value('id,name,name_en,imageindex,imageindex_en,bgcolor')->where('`show_hidden` = \'1\' AND `parentid` = \'0\'')->order_asc('name')->find();
		}

		foreach ($CateRand as $caterand) {

			if(_LANG_DIGI_=='en' || _LANG_DIGI_=='cn'){
				$catename=$caterand->name_en;
				$Catesub = $database->table('categorys')->value('id,parentid,name_en')->where('`show_hidden` = \'1\' AND `parentid` = \''.$caterand->id.'\'')->order_asc('name_en')->find();

			}else{
				$catename=$caterand->name;
				$Catesub = $database->table('categorys')->value('id,parentid,name')->where('`show_hidden` = \'1\' AND `parentid` = \''.$caterand->id.'\'')->order_asc('name')->find();
			}


			$cate .= '<li class="has-cat-mega">
			<a href="'.BASE_URL.'product/c/'.$caterand->id.'/'.$this->url_clean($catename).'.html"><img src="'.BASE_URL.'static/new/images/cat-icon/bk-'.$caterand->id.'.png" alt=""><span>'.$catename.'</span></a>
			<div class="cat-mega-menu cat-mega-style1"><div class="row"><div class="col-md-4 col-sm-3"><div class="list-cat-mega-menu"><h2 class="title-cat-mega-menu">'.$catename.'</h2><ul>';


			for ($i=0; $i < count($Catesub) ; $i++){

				if(_LANG_DIGI_=='en' || _LANG_DIGI_=='cn'){
					$catenamesub=$Catesub[$i]->name_en;
				}else{
					$catenamesub=$Catesub[$i]->name;
				}

				$cate .='<li><a href="'.BASE_URL.'product/c/'.$Catesub[$i]->parentid.'/'.$this->url_clean($catename).'/'.$Catesub[$i]->id.'/'.$this->url_clean($catenamesub).'.html">'.$catenamesub.'</a></li>';

			}

			$cate .='<li><a href="'.BASE_URL.'product/c/'.$caterand->id.'/'.$this->url_clean($catename).'.html">'.LANG_015.'</a></li>';


			$product_ = $database->table('product')->value('id,cashback_percent,imageshow_cover,name_product,name_product_sale,nat_price,snat_price,qty,qty_sale,aff_percent,promotion_id')->where('`categoryid` =\''.$caterand->id.'\' AND `show_hidden` = \'1\' AND `qty_sale` > \'0\'')->order_by('RAND()')->limit('2')->find();


			$cate .='</ul>
			</div>
			</div>';


			foreach ($product_ as $product) {

				if($product->promotion_id != '0'){
					$promotion_price = $this->checkinpromotion($database,$product->id,$product->promotion_id);
					if($promotion_price){
						$product->nat_price = $promotion_price->pr_price;
						$product->qty_sale = $product->qty_sale + $promotion_price->qty_limit - $promotion_price->qty_sale;
						if($product->qty_sale <= 0){
							$product->qty_sale = 0;
						}

						if($promotion_price->product_image != ''){
							$product->imageshow_cover = $promotion_price->product_image;
						}
						if(strip_tags($promotion_price->detail_product_mobile) != ''){
							$product->details = $promotion_price->detail_product_mobile;
						}
						if(strip_tags($promotion_price->detail_product) != ''){
							$product->details_web = $promotion_price->detail_product;
						}
						if($promotion_price->cashback != '-1'){
							$product->cashback_percent = $promotion_price->cashback;
						}
						if($promotion_price->cashback_aff != '-1'){
							$product->aff_percent = $promotion_price->cashback_aff;
						}
						
					}
				}else{
					$promotion_price = false;
				}

				$prict_product = $this->priceproduct_arr($product);

				if($product->name_product_sale != ''){
					$name_product = strip_tags($product->name_product_sale);
				}else{
					$name_product = strip_tags($product->name_product);
				}


				$cate .='<div class="col-md-4 col-sm-3">
				<div class="item-product-ajax item-product first-item">
				<div class="product-thumb">
				<a class="product-thumb-link" href="'.BASE_URL.'product/detail/'.$product->id.'/'.$this->url_clean($product->name_product).'.html">
				<img src="'.BASE_URL.'static/images/lazy.gif" data-src="'.BASE_URL.'static/img/'.$product->imageshow_cover.'" class="lazyload">
				</a>
				<div class="product-extra-link">
				'.$this->add_cart_buynow($product,$prict_product[0]).$this->favourite($product->id,$database).'
				</div>
				</div>
				<div class="product-info">
				<h3 class="product-title"><a href="'.BASE_URL.'product/detail/'.$product->id.'/'.$this->url_clean($product->name_product).'.html">'.$name_product.'</a></h3>
				<div class="product-price">
				'.$prict_product[1].'
				</div>
				<div>
				<span class="coin-cash-s"></span> <span class="sum-cashback">'.floor($prict_product[2]).'</span>
				</div>
				</div>
				</div>
				</div>';


			}



			$cate .='</div></div></li>';


		}

		return $cate;

	}

	public function getproductrand($catid='',$limit='4',$db='')
	{
		if($catid != ''){
			$cat = 'AND `categoryid` = \''.$catid.'\'';
		}else{
			$cat = '';
		}
		$productrand = $db->table('product')->value('id,cashback_percent,imageshow_cover,name_product,name_product_sale,nat_price,snat_price,aff_percent,qty,qty_sale,promotion_id,gift,brand')->where('`show_hidden` = \'1\' '.$cat.' ')->order_by('RAND()')->limit($limit)->find();
		return  $productrand;
	}

	function checkinpromotion33($db,$id,$promoid=''){
		// $promotion = $db->table('promotion')->find_one('PromtionId',$promoid);

		$date_now = date('Y-m-d');

		// $time_now = date('H:i:s');

		$promotion = $db->raw('
			SELECT id FROM `promotion`
			WHERE `PromtionId` = \''.$promoid.'\' 
		');

		// `status` = \'1\' AND `status_admin` = \'1\' AND  AND `time_start` <= \''.$time_now.'\' AND `time_end` >= \''.$time_now.'\' AND `PromotionStart` <= \''.$date_now.'\' AND `PromotionEnd` >= \''.$date_now.'\' 


		if($promotion){
		
			$promotion_detail = $db->table('promotion_detail')->value('qty_limit,qty_sale,limit_buy_user,fake_price,pr_price,product_image,detail_product_mobile,detail_product,cashback,cashback_aff')->where('`PromtionId` = \''.$promoid.'\' AND `pid` = \''.$id.'\' AND `show_hidden` = \'1\' AND `qty_limit` != \'0\'')->find_one();

		
			if($promotion_detail){
				$datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND od.pid = \''.$id.'\' AND op.status != "7"'); // count order buy product in promotion


				if (intval($datacount[0]->total) < $promotion_detail->qty_limit) { // check total buy product in promotion limit buy

					if ($promotion_detail->limit_buy_user != 0 && isset($_SESSION['user_acc']['id'])) {  // check user limit buy product

						$datacount_limit_us = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND od.pid = \''.$id.'\' AND od.uid = \''.$_SESSION['user_acc']['id'].'\' AND op.status != "7"');

						if (intval($datacount_limit_us[0]->total) >= $promotion_detail->limit_buy_user) { // check product mex limit user buy product in promotion
							// $promotion_detail->prod_max_limit_user = true; // max limit buy user
							// return false;
							$promotion_detail->status_qty = 'limit_buy_user';
							return $promotion_detail;
							// return 'limit_buy_user';
						}else{
							return $promotion_detail;
						}

					}else{
						return $promotion_detail;
					}

				}else{
					$promotion_detail->status_qty = 'qty_limit';
					return $promotion_detail;
					// return 'qty_limit';
					// $promotion_detail->prod_mod_promo = true; // product in promotion out of promotion
					// return false;
				}

				// return $promotion_detail;
				// $datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND od.pid = \''.$id.'\' AND op.status != "7"');
	
				// if (intval($datacount[0]->total) < $promotion_detail->qty_limit) {
				// 	return $promotion_detail;
				// }else{
				// 	return false;
				// }
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function checkinpromotion($db,$id,$promoid=''){
		$promotion = $db->table('promotion')->find_one('PromtionId',$promoid);
		if($promotion->status == '1' && $promotion->status_admin == '1'){
			if($promotion->PromotionStart.' '.$promotion->time_start <= date('Y-m-d H:i:s') && $promotion->PromotionEnd.' '.$promotion->time_end >= date('Y-m-d H:i:s')){
				$promotion_detail = $db->table('promotion_detail')->where('`PromtionId` = \''.$promoid.'\' AND `pid` = \''.$id.'\'')->find_one();
				if($promotion_detail->show_hidden == '1'){
					if($promotion_detail->qty_limit == 0){
						return false;
					}else{
						$datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND od.pid = \''.$id.'\' AND op.status != "7"');
						// var_dump($datacount[0]->total);
						// var_dump($promotion_detail->qty_limit);
						if (intval($datacount[0]->total) < $promotion_detail->qty_limit) {
							return $promotion_detail;
						}else{
							return 'pro_mod';
						}
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function checkinpromotion_flash($db,$id,$promoid=''){
		$promotion = $db->table('promotion')->find_one('PromtionId',$promoid);

		$date = date('Y-m-d h:i:s');
		if ($promotion->PromotionStart.' '.$promotion->time_start <= $date && $promotion->PromotionEnd.' '.$promotion->time_end >= $date){

			if($promotion->status == '1' && $promotion->status_admin == '1'){
				if($promotion->PromotionStart <= date('Y-m-d') && $promotion->PromotionEnd >= date('Y-m-d')){
					$promotion_detail = $db->table('promotion_detail')->where('`PromtionId` = \''.$promoid.'\' AND `pid` = \''.$id.'\'')->find_one();
					if($promotion_detail->show_hidden == '1'){
						if($promotion_detail->qty_limit == 0){
							return false;
						}else{
							$datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND  od.pid = \''.$id.'\' AND op.status != "7"');
							if (intval($datacount[0]->total) < $promotion_detail->qty_limit) {
								return $promotion_detail;
							}else{
								return false;
							}
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			$promotion_detail = $db->table('promotion_detail')->where('`PromtionId` = \''.$promoid.'\' AND `pid` = \''.$id.'\'')->find_one();
			return $promotion_detail;
		}
	}

	function inpromotion($promotion_price){
		if($promotion_price){
			return '<div class="special_price"><strong>SPECIAL</strong> <span>PRICE</span></div>';
		}
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

	public function check_follow_store($d='',$sid='',$mid='')
	{
		$storefollow = $d->table('storefollow')->value('Id')->where('`MemberSid` = \''.$mid.'\' AND `StoreSid` = \''.$sid.'\'')->limit('1')->find();
		if($storefollow){
			return 'success';
		}else{
			return 'danger';
		}
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

	public function favourite($id='',$db='')
	{

		if (isset($_SESSION['user_acc']['id'])) {
			if($this->product_favourite($id,$db)){
				$favourite = ' <a href="javascript:void(0)" title="Favourite" onclick="remove_fovarite_all(this,'.$_SESSION['user_acc']['id'].','.$id.');" class="wishlist-link"><i class="fas fa-heart" aria-hidden="true"></i></a> <a href="javascript:void(0)" class="compare-link" onclick="window.location.reload(true);"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
			}else{
				$favourite = ' <a href="javascript:void(0)" title="Favourite" onclick="add_favorite_all(this,'.$_SESSION['user_acc']['id'].','.$id.');" class="wishlist-link"><i class="far fa-heart" aria-hidden="true"></i></a> <a href="javascript:void(0)" class="compare-link" onclick="window.location.reload(true);"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
			}
		}else{
			$favourite = ' <a href="'.BASE_URL.'login" title="Favourite" class="wishlist-link"><i class="far fa-heart" aria-hidden="true"></i></a> <a href="javascript:void(0)" class="compare-link" onclick="window.location.reload(true);"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
		}
		return $favourite;
	}

	public function favourite_old($id='',$db='')
	{
		if (isset($_SESSION['user_acc']['id'])) {
			if($this->product_favourite($id,$db)){
				$favourite = '<a href="javascript:void(0)" title="Favourite" onclick="remove_fovarite_all(this,'.$_SESSION['user_acc']['id'].','.$id.');" class="btn-item-wish-sq"><i class="fa fa-heart" aria-hidden="true"></i></a>';
			}else{
				$favourite = '<a href="javascript:void(0)" title="Favourite" onclick="add_favorite_all(this,'.$_SESSION['user_acc']['id'].','.$id.');" class="btn-item-wish-sq"><i class="fa fa-heart-o" aria-hidden="true"></i></a>';
			}
		}else{
			$favourite = '<a href="'.BASE_URL.'login" title="Favourite" class="btn-item-wish-sq"><i class="fa fa-heart-o" aria-hidden="true"></i></a>';
		}
		return $favourite;
	}


	public function product_favourite($id,$db)
	{
		$product_favourite = $db->table('product_favourite')->where('`pid` = \''.$id.'\' AND `id_user` = \''.$_SESSION['user_acc']['id'].'\'')->find();
		return $product_favourite;
	}

	public function add_cart_buynow($productalls='',$prict_product='',$type='0',$mobione='btn-item-buy-sq',$hotdeales=0)
	{

		if($type==1){
			$text='ซื้อเลยตอนนี้';
		}else if($type==2){
			$text='รอเวลาซื้อสินค้า';
		}else{
			$text='<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
		}


		if($type==2){

			$htmldata = '<a href="javascript:void(0)" class="btn-item-buy-sq" disable>'.$text.'</a>';

		}else{

			$htmldata = '<form id="cart_'.$productalls->id.'">';
			$htmldata .= '<input type="hidden" name="pricecashback" value="'.$productalls->cashback_percent.'">';
			$htmldata .= '<input type="hidden" name="affpercent" value="'.$productalls->aff_percent.'">';
			$htmldata .= '<input type="hidden" name="productname" value="'.strip_tags($productalls->name_product).'">
			<input type="hidden" name="productid" value="'.$productalls->id.'">
			<input type="hidden" name="imageshow" value="'.$productalls->imageshow_cover.'">
			<input type="hidden" name="productprice" value="'.$prict_product.'">
			<input type="hidden" name="qty" value="1">
			<input type="hidden" name="stockin" value="'.$productalls->qty.'">';

			if($hotdeales == 1){
				$htmldata .= '<input type="hidden" name="promoid" value="'.$productalls->hot_deals.'">';
				$htmldata .= '<input type="hidden" name="hotdeales" value="1">';
				$htmldata .= '<input type="hidden" name="gift" value="'.@$productalls->gift.'">';
				$htmldata .= '</form>';
				$htmldata .= '<a href="javascript:void(0)" onclick="buynow_(\'cart_'.$productalls->id.'\');" title="Buy Now" class="'.$mobione.'">คุณชนะ สั่งชื้อเลย</a>';
			}else{
				$htmldata .= '<input type="hidden" name="promoid" value="'.$productalls->promotion_id.'">';
				$htmldata .= '<input type="hidden" name="hotdeales" value="0">';
				$htmldata .= '<input type="hidden" name="gift" value="'.@$productalls->gift.'">';
				$htmldata .= '</form>';
				$htmldata .= '<a href="javascript:void(0)" onclick="buynow_(\'cart_'.$productalls->id.'\');" title="Buy Now" class="'.$mobione.'">'.$text.'</a>';
			}


		}

		return $htmldata;
	}

	public function add_cart_buynow_old($productalls='',$prict_product='',$type='0',$mobione='btn-item-buy-sq',$hotdeales=0)
	{

		if($type==1){
			$text='ซื้อเลยตอนนี้';
		}else if($type==2){
			$text='รอเวลาซื้อสินค้า';
		}else{
			$text='<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
		}


		if($type==2){

			$htmldata = '<a href="javascript:void(0)" class="btn-item-buy-sq" disable>'.$text.'</a>';

		}else{

			$htmldata = '<form id="cart_'.$productalls->id.'">';
			$htmldata .= '<input type="hidden" name="pricecashback" value="'.$productalls->cashback_percent.'">';
			$htmldata .= '<input type="hidden" name="affpercent" value="'.$productalls->aff_percent.'">';
			$htmldata .= '<input type="hidden" name="productname" value="'.strip_tags($productalls->name_product).'">
			<input type="hidden" name="productid" value="'.$productalls->id.'">
			<input type="hidden" name="imageshow" value="'.$productalls->imageshow_cover.'">
			<input type="hidden" name="productprice" value="'.$prict_product.'">
			<input type="hidden" name="qty" value="1">
			<input type="hidden" name="stockin" value="'.$productalls->qty.'">';

			if($hotdeales == 1){
				$htmldata .= '<input type="hidden" name="promoid" value="'.$productalls->hot_deals.'">';
				$htmldata .= '<input type="hidden" name="hotdeales" value="1">';
				$htmldata .= '<input type="hidden" name="gift" value="'.@$productalls->gift.'">';
				$htmldata .= '</form>';
				$htmldata .= '<a href="javascript:void(0)" onclick="buynow_(\'cart_'.$productalls->id.'\');" title="Buy Now" class="'.$mobione.'">คุณชนะ สั่งชื้อเลย</a>';
			}else{
				$htmldata .= '<input type="hidden" name="promoid" value="'.$productalls->promotion_id.'">';
				$htmldata .= '<input type="hidden" name="hotdeales" value="0">';
				$htmldata .= '<input type="hidden" name="gift" value="'.@$productalls->gift.'">';
				$htmldata .= '</form>';
				$htmldata .= '<a href="javascript:void(0)" onclick="buynow_(\'cart_'.$productalls->id.'\');" title="Buy Now" class="'.$mobione.'">'.$text.'</a>';
			}


		}

		return $htmldata;
	}
	// public function calc2($a='',$b='') {
	// 	$c = $a/$b;
	// 	$d = $c*100;
	// 	return number_format($d-100);
	// }
	public function calc2($a='',$b='') {
		$num1 = $a;
		$num2 = $b;
		$z = (($num2 - $num1) / $num2 * 100);
		return number_format($z);
	}
	// public function calc22($a='',$b='') {
	// 	$c = $a/$b;
	// 	$d = $c*100;
	// 	return number_format($d-100,2);
	// }
	public function calc22($a='',$b='') {
		$num1 = $a;
		$num2 = $b;
		$z = (($num2 - $num1) / $num2 * 100);
		return number_format($z,2);
	}
	
	public function priceproduct($product='',$detail='',$db='')
	{
		$prict_product = array();
		// if ($db != '') {
		// 	$date = date('Y-m-d H:i:s');

		// 	$activity = $db->table('product_activity_date')->where('`status` = \'1\' AND `date_start` <= \''.$date.'\' AND `date_end` >= \''.$date.'\'')->order_by('id')->find_one();

		// 	$count_ = $db->table('product_activity_item')->count()->value('id')->where('status = \'1\' AND product_id = \''.$product->id.'\' AND product_activity_date_id = \''.$activity->id.'\'')->find_all();
		// }else{
		// 	$count_[0]->total = 0;
		// }

		// if ($count_[0]->total > 0) {
		// 	$date = date('Y-m-d H:i:s');

		// 	$activity = $db->table('product_activity_date')->where('`status` = \'1\' AND `date_start` <= \''.$date.'\' AND `date_end` >= \''.$date.'\'')->order_by('id')->find_one();

		// 	$product_price = $db->table('product_activity_item')->value('price,cash_back')->where('status = \'1\' AND product_id = \''.$product->id.'\' AND product_activity_date_id = \''.$activity->id.'\'')->find_one();

		// 	$prict_product[0] = $product_price->price;
		// 	$prict_product[1] = '<ins><span>฿'.number_format($product_price->price).'</span></ins> <del><span>฿'.number_format($product->snat_price).'</span></del>';
		// 	$prict_product[2] = $product_price->price * $product_price->cash_back / 100;
		// }else{
		if($product->snat_price == '' || $product->snat_price == '0'){
			$prict_product[0] = $product->nat_price;
			$prict_product[1] = '<ins>'.number_format($product->nat_price)." ".LANG_Bath.'</ins>';
			$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;
		}else{
			if($product->nat_price == '' || $product->nat_price == '0'){
				$prict_product[0] = $product->snat_price;
				$prict_product[1] = '<ins>'.number_format($product->snat_price)." ".LANG_Bath.'</ins>';
				$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;
			}else{

				if($product->nat_price == $product->snat_price){

					$prict_product[0] = $product->snat_price;
					$prict_product[1] = '<ins>'.number_format($product->snat_price)." ".LANG_Bath.'</ins>';
					$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;

				}else{

					$prict_product[0] = $product->nat_price;

					$prict_product[1] = '<ins>'.number_format($product->nat_price)." ".LANG_Bath."</ins> <del>".number_format($product->snat_price)." ".LANG_Bath."</del>";

					if($this->calc2($product->nat_price,$product->snat_price) != 0){
						if($detail == ''){
							$prict_product[1] .= '<span class="onsale">-'.$this->calc2($product->nat_price,$product->snat_price).'%</span>';
						}else{
							$prict_product[3] = str_replace('-','',$this->calc2($product->nat_price,$product->snat_price));
							$prict_product[4] = $this->calc22($product->nat_price,$product->snat_price);
						}
					}

					$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;

				}
			}
		}
		// }
		return $prict_product;
	}

	public function priceproduct_arr_flas($product='',$detail='',$db='',$id)
	{

		$prict_product = array();
		if ($db != '') {

			$product_price = $db->table('product_activity_item')->value('price,cash_back')->where('status = \'1\' AND product_id = \''.$product->id.'\' AND product_activity_date_id = \''.$id.'\'')->find_one();

			$prict_product[0] = $product_price->price;
			if ($product_price->price == $product->snat_price) {
				$prict_product[1] = '<ins><span>฿'.number_format($product_price->price).'</span></ins>';
			}else{
				$prict_product[1] = '<ins><span>฿'.number_format($product_price->price).'</span></ins><del><span>฿'.number_format($product->snat_price).'</span></del>';
			}
			$prict_product[2] = $product_price->price * $product_price->cash_back / 100;

		}else{

			// $count_[0]->total = 0;
		}
		
		return $prict_product;
	}
	
	public function count_order_buy_promotion($db,$promoid,$qty_sale='',$pid='')
	{
		$datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = "'.$promoid.'" AND od.pid = "'.$pid.'" AND op.status != "7"');
		if (intval($datacount[0]->total) < $qty_sale) {
			return true;
		}else{
			return false;
		}
	}

	public function count_order_buy_promotion_percen($db,$promoid,$qty_sale='',$pid='')
	{
		$datacount = $db->raw('SELECT COUNT(od.id) as total FROM `order_detail` as od JOIN `order_product` as op ON op.oid = od.oid WHERE od.promotion_id = \''.$promoid.'\' AND od.pid = \''.$pid.'\' AND op.status != "7"');

		// var_dump(intval($datacount[0]->total) * 100) / intval($qty_sale);
		if ($datacount[0]->total != 0) {
			return (intval($datacount[0]->total) * 100) / intval($qty_sale);
		}else{
			return $datacount[0]->total;
		}
		

	}
	
	public function calpriceproduct($product='',$detail='',$db='')
	{

		$prict_product = array();

		if (isset($product->price)) {
			$prict_product[0] = $product->price;
			$prict_product[1] = '<ins><span>฿'.number_format($product->price).'</span></ins>';
			$prict_product[2] = $product->price * $product->cash_back / 100;
		}elseif($product->snat_price == '' || $product->snat_price == '0'){
			$prict_product[0] = $product->nat_price;
			$prict_product[1] = '<ins><span>฿'.number_format($product->nat_price).'</span></ins>';
			$prict_product[5] = "<ins><span>฿".number_format($product->nat_price)."</span></ins>";
			$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;
		}else{
			if($product->nat_price == '' || $product->nat_price == '0'){
				$prict_product[0] = $product->snat_price;
				$prict_product[1] = '<ins><span>฿'.number_format($product->snat_price).'</span></ins>';
				$prict_product[5] = "<ins><span>฿".number_format($product->snat_price)."</span></ins>";
				$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;
			}else{

				if($product->nat_price == $product->snat_price){

					$prict_product[0] = $product->snat_price;
					$prict_product[1] = '<ins><span>฿'.number_format($product->snat_price).'</span></ins>';
					$prict_product[5] = "<ins><span>฿".number_format($product->snat_price)."</span></ins>";
					$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;

				}else{

					$prict_product[0] = $product->nat_price;

					$prict_product[1] = "<ins><span>฿".number_format($product->nat_price)."</span></ins><del><span>฿".number_format($product->snat_price)."</span></del>";

					$prict_product[5] = "<ins><span>฿".number_format($product->nat_price)."</span></ins>";

					if($this->calc2($product->nat_price,$product->snat_price) != 0){
						if($detail == ''){
							$prict_product[3] = $this->calc2($product->nat_price,$product->snat_price);
						}else{
							$prict_product[3] = str_replace('','',$this->calc2($product->nat_price,$product->snat_price));
							$prict_product[4] = $this->calc22($product->nat_price,$product->snat_price);
						}
					}

					$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;

				}
			}
		}

		$prict_product[2] = floor($prict_product[2]);

		return $prict_product;
	}

	public function priceproduct_arr($product='',$detail='',$db='')
	{
		// $prict_product = array();
		// if ($db != '') {
		// 	$date = date('Y-m-d H:i:s');

		// 	$activity = $db->table('product_activity_date')->where('`status` = \'1\' AND `date_start` <= \''.$date.'\' AND `date_end` >= \''.$date.'\'')->order_by('id')->find_one();
			
		// 	$count_ = $db->table('product_activity_item')->count()->value('id')->where('status = \'1\' AND product_id = \''.$product->id.'\' AND product_activity_date_id = \''.$activity->id.'\'')->find_all();
		// }else{
		// 	$count_[0]->total = 0;
		// }
		
		// if ($count_[0]->total > 0) {
		// 	$date = date('Y-m-d H:i:s');

		// 	$activity = $db->table('product_activity_date')->where('`status` = \'1\' AND `date_start` <= \''.$date.'\' AND `date_end` >= \''.$date.'\'')->order_by('id')->find_one();

		// 	$product_price = $db->table('product_activity_item')->value('price,cash_back')->where('status = \'1\' AND product_id = \''.$product->id.'\' AND product_activity_date_id = \''.$activity->id.'\'')->find_one();

		// 	$prict_product[0] = $product_price->price;
		// 	$prict_product[5] = $product->snat_price;
		// 	$prict_product[1] = '<ins><span>฿'.number_format($product_price->price).'</span></ins><del><span>฿'.number_format($product->snat_price).'</span></del>';
		// 	$prict_product[2] = $product_price->price * $product_price->cash_back / 100;
		// }else{
			if($product->snat_price == '' || $product->snat_price == '0'){
				$prict_product[0] = $product->nat_price;
				$prict_product[5] = $product->snat_price;
				$prict_product[1] = '<ins><span>฿'.number_format($product->nat_price).'</span></ins>';
				$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;
			}else{
				if($product->nat_price == '' || $product->nat_price == '0'){
					$prict_product[0] = $product->snat_price;
					$prict_product[5] = $product->nat_price;
					$prict_product[1] = '<ins><span>฿'.number_format($product->snat_price).'</span></ins>';
					$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;
				}else{

					if($product->nat_price == $product->snat_price){

						$prict_product[0] = $product->snat_price;
						$prict_product[5] = $product->nat_price;
						$prict_product[1] = '<ins><span>฿'.number_format($product->snat_price).'</span></ins>';
						$prict_product[2] = $product->snat_price * $product->cashback_percent / 100;

					}else{

						$prict_product[0] = $product->nat_price;
						$prict_product[5] = $product->snat_price;

						$prict_product[1] = "<del><span>฿".number_format($product->snat_price).'</span></del> <ins><span>฿'.number_format($product->nat_price).'</span></ins>';

						if($this->calc2($product->nat_price,$product->snat_price) != 0){
							if($detail == ''){
								$prict_product[3] = $this->calc2($product->nat_price,$product->snat_price);
							}else{
								$prict_product[3] = str_replace('-','',$this->calc2($product->nat_price,$product->snat_price));
								$prict_product[4] = $this->calc22($product->nat_price,$product->snat_price);
							}
						}

						$prict_product[2] = $product->nat_price * $product->cashback_percent / 100;

					}
				}
			}
		// }
		return $prict_product;
	}



	public function amount_2c2p($amount=''){

		$amount_01=substr($amount, -2);
		$amount_02=substr($amount,0, -2);

		return $amount_02.'.'.$amount_01;

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
	public function cou_cate_active($id,$db='')
	{
		$category = $db->table('categorys')->value('name')->where('`id` = \''.$id.'\'')->find_one();

		return $category->name;
	}
	function donate_cash($db='',$user_id = '',$pro_id='',$cashback='',$proname=''){
		if(isset($user_id) && is_numeric($user_id)){
			if($user_id >= 1){
				// $count_transactions_register = $db->table('transactions')->no_cache()->where('`user_id` = \''.$user_id.'\' AND `eventbox` = \'buyfirst\' AND `refbuycancel` = \'0\'')->find_one();
				// if($count_transactions_register){

					// $count_transactions_register->set('refbuycancel','1');
					// $count_transactions_register->save();

					// $setting_app = $db->table('setting_app')->no_cache()->where()->find_one('id','1');
					// $price_cashback_f = $setting_app->price_fbuy;
					$transactions = $db->table('transactions')->create();
					$transactions->set('tras_id','TRA'.time().'DONATE');
					// $transactions->set('inv_id',$inv);
					$transactions->set('detail_','บริจาก '.$proname.' '.$cashback.' cashback');
					$transactions->set('user_id',$user_id);
					$transactions->set('price_total',$cashback);
					$transactions->set('confirmed_by','1');
					$transactions->set('admin_id','0');
					$transactions->set('status','2');
					$transactions->set('status_pay','6');
					$transactions->set('status_confirm','1');
					$transactions->set('cashback','1');
					$transactions->set('eventbox','donate_'.$pro_id);
					$transactions->set('eventboxip',$this->usergetip());
					$transactions->save();

					$user_acc = $db->table('user_acc')->find_one('id',$user_id);
					$final_cash = $user_acc->cash_total - $cashback;
					$user_acc->set('cash_total',$final_cash);
					$user_acc->set('fbuy','0');
					$user_acc->save();

				// }
			}
		}
	}

	public function usergetip() {
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

	public function check_mycoupon_keep($id,$db='')
	{
		$mycoupon = $db->table('mycoupon')->where('`code_id` = \''.$id.'\' AND user_id = \''.$_SESSION['user_acc']['id'].'\'')->find_one();
		$coupon = $db->table('promocode')->where('`id` = \''.$id.'\'')->find_one();

		if ($coupon->total_limit != 0 && $coupon->remain_give_limit == 0) {
			return 'depleted'; // หมด
		}else{
		// if ($mycoupon->id) {
		// 	return 'keep';  // เก็บแล้ว
		// }else{
			return 'succ';  // เก็บแล้ว

		}
		
	}

}
?>