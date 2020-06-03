<!DOCTYPE html>
<html>

<head>
	<title>API Document V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
		integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css"
		integrity="sha256-6hqHMqXTVEds1R8HgKisLm3l/doneQs+rS1a5NLmwwo=" crossorigin="anonymous" />
	<style type="text/css">
		* {
			font-family: 'Kanit' !important;
		}
	</style>
</head>

<body>
	<div class="container">

		<div class="blog-header">
			<h1 class="blog-title">API Document</h1>
			<div class="row">
				<div class="col-md-3">
					<code>ค่าตัวแปร ใช้ใน where</code>
					<code class="text-info">
						<br>"{id};eq;{1}" -> "="
						<br>"{id};neq;{1}" -> "!="
						<br>"{id};neq;{1};and;{id};neq;{5}" -> "AND &&"
						<br>"{id};eq;{1};or;{id};eq;{5}" -> "OR ||"
						<br>";0;" -> "ค่า null"
						<br>";00;" -> "ค่าว่าง"
						<br>";like;" -> "LIKE"
						<br>";ap;" -> "%"
						<br>";moreeq;" -> ">="
						<br>";lesseq;" -> "<="
						<br>";more;" -> ">"
						<br>";less;" -> "<"
						<br>";rlike;" -> "RLIKE"
					</code>
				</div>
				<div class="col-md-3">
					<code>ค่าตัวแปร ใช้ใน order</code>
					<code class="text-info">
						<br>"{id};asc" -> "น้อยไปมาก"
						<br>"{id};desc" -> "มากไปน้อย"
						<br>";rand" -> "สุ่ม"
					</code>
				</div>
				<div class="col-md-3">
					<code>ค่าตัวแปร GET ต่างๆ</code>
					<code class="text-info">
						<br>"?limit=" -> "int หรือ all"
						<br>"?order=" -> ";rand หรือ {id};asc"
						<br>"?where=" -> "{id};neq;{1} หรือ {id};neq;{1};and;{id};neq;{5}"
						<br>"?value=" -> "{sku_id},{sku_item},{sku_sub}"
						<br>"?in=" -> "{1},{2},{3}"
					</code>
				</div>
				<div class="col-md-3">
					<code>ค่าตัวแปร POST ต่างๆ</code>
					<code class="text-info">
						<br>"action" -> "add หรือ update หรือ delete"
						<br>"token" -> "ตั้งจากไฟล์ config.php -> define('TOKEN_ACTION_API', '123456789');"
					</code>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">

			<div class="col-sm-12">
			<h4>API</h4>

			<?php
				foreach ($api as $key => $value) {
					echo '
					<a id="focus_'.$key.'" role="button" data-toggle="collapse" href="#api'.$key.'" aria-expanded="false" aria-controls="collapseExample">
					'.$actual_link.'/'.$key.' <small>'.$value_api[$key].'</small>
					</a><br>
			
						<div class="collapse" id="api'.$key.'">
							<div class="panel panel-default">
								<div class="panel-heading">วิธีใช้ </div>
								<div class="panel-body">

									<p><code>ดึงรายการทั้งหมด</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'</p>
									<p><code>ดึงจาก Field</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/id/1</p>
									<p><code>ดึงจาก Field</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?where='.$value[0]->Field.';eq;5;or;etc;neq;;0;</p>
									<p><code>ค้นหา Field</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?where='.$value[0]->Field.';like;;ap;คำค้น;ap;</p>
									<p><code>จำกัดการดึง</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?limit=5</p>
									<p><code>จัดเรียง</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?order='.$value[0]->Field.';asc</p>
									<p><code>สุ่ม</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?order=;rand</p>
									<p><code>มากกว่า น้อยกว่า</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?where='.$value[0]->Field.';moreeq;5;and;'.$value[0]->Field.';lesseq;999&value='.$value[0]->Field.'</p>
									<p><code>เอาเฉพาะฟิว</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?value='.$value[0]->Field.',etc,etc2</p>
									<p><code>ค้นหาในฟิว เท่ากับ</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?in='.$value[0]->Field.';sin;1,2,3;ein;</p>
									<p><code>ค้นหาในฟิว LIKE</code> _GET:'.BASE_URL.$actual_link.'/'.$key.'/?where='.$value[0]->Field.';rlike;1|2|3</p>

								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">Field '.ucwords(str_replace('_', ' ', $key)).'</div>
								<div class="panel-body">
								Js Code
<pre>
fetch(`'.BASE_URL.$actual_link.'/'.$key.'/?limit=5`)
.then(response => response.json())
.then(result => {
	console.log(result)
})
.catch(error => console.log(\'error\', error));

const func = async () => {
	const response = await fetch(`'.BASE_URL.$actual_link.'/'.$key.'/?limit=5`);
	const result = await response.json();
	return <'.$key.'>result;
}

interface '.$key.' {
	status: boolean;
	data: {';
		foreach ($value as $key => $values) {
			echo "\r	".$values->Field.':'.$values->Type;
		}
		echo '}[];
};
</pre>';
								
								foreach ($value as $key => $values) {
											$values->Default = ($values->Default == '') ? 'None' : '<span class="label label-info">'.$values->Default.'</span>';
											$values->Key = ($values->Key != '') ? ' -> <span class="label label-success">'.$values->Key.'</span>':'';
											$values->Extra = ($values->Extra == 'auto_increment') ? ' -> <span class="label label-warning">Auto ID</span>':'';
											echo '
											<div class="col-md-3">
												<span class="label label-default">
													Field:</span><code>'.$values->Field.''.$values->Key.''.$values->Extra.'</code><br>
													Type:<code>'.$values->Type.'</code><br>
													Default:<code>'.$values->Default.'</code><br>
													Comment:<code>'.$values->Comment.'</code><hr>
											</div>';
									}

								echo '</div>
							</div>
						</div>
				';
					}
			?>
			</div>
		</div>

	</div>

	<div class="text-center"><a href="https://cii3.net">by cii3.net</a></div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"
		integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
		crossorigin="anonymous"></script>
	<script type="text/javascript">
		$('a[href*="#"]:not([href="#"])').click(function () {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	</script>
</body>

</html>