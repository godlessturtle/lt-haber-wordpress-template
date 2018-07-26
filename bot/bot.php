<?php 

//bu sayfada haber botunun çalışması için veri çekimi ve post insert işlemi yapıldı.


include '../../../../wp-config.php';
date_default_timezone_set("Europe/Istanbul");
error_reporting(0);
function Baglan($url){
	$curl=curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	$veri=curl_exec($curl);
	echo curl_error($curl);
	curl_close($curl);
	return str_replace(array("\n","\t","\r"),null,$veri);
}

if(isset($_POST['haberAdres'])){
	$url = $_POST['haberAdres'];
	$address = Baglan($url);
	preg_match_all('#<div class="story-body__inner" property="articleBody">(.*?)<p>(.*?)</p>(.*?)</div>#',$address,$content);
	preg_match_all('#<h1 class="story-body__h1">(.*?)</h1>#',$address,$title);
//print_r($content[0][0]);
//print_r($title[0][0]);

	//gelen haberleri burada wordpress db sistemine gönderiyorum.
	$my_post = array(
		'post_title'    => strip_tags($title[0][0]),
		'post_content'  => $content[0][0],
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_category' => array( 9 ),
		'tags_input'	  => array('haber','bot')
	);

	if(wp_insert_post( $my_post )){
		Header("Location:".bloginfo('url')."/wordpress/wp-admin/admin.php?page=admin%2Fmenu.php");
	}

}








?>