<?php

/*********************************************************

	Wordpress geliştirici topluluğu,functions.php dosyasının fazla kodla doldurulmamasını önerdiğinden aşağıda ek tema fonksiyonlarının bulunduğu dosyalar functions.php dosyasına include edilmiştir.

	*********************************************************/
// eklenti,menü ve kullanıcının fazla uğraşmaması gereken detaylı tema fonksiyonları aşağıdaki dosyada tutulmaktadır.
	require_once get_template_directory() . '/includes/theme-init.php';


//Temaya özel sidebar ve footer bileşenleri oluşturdum,bunları includes/tema-bilesenleri.php dosyasında bulabilirsiniz.
	require_once get_template_directory() . '/includes/tema-bilesenleri.php';


/*********************************************************

	Anasayfadaki duyuru/bilgi mesajlarını burada yazıp admin_notices metodu ile wp-admin paneline gönderdim.

	*********************************************************/

	function sample_admin_notice__onemli() {
		?>
		<div id="gorunurluk" class="notice notice-warning is-dismissible">
			<p><?php _e( '<h2>Önemli Not!</h2>Tema yüklemesi yapıldıktan sonra eklentiler menüsündeki gerekli eklentilerin kurulması gerekiyor.(Option Tree)', 'sample-text-domain' ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'sample_admin_notice__onemli' );


//anasayfadaki diğer notu burada ekledim
	function sample_admin_notice__success() {
		?>
		<div id="gorunurluk2" class="notice notice-success is-dismissible">
			<p>
				

				<h2 style="margin-bottom: -30px;">
				<span style="font-size: 110px;color: red;">!</span>
				</h2><br>
				<h2>Başlamadan Önce Okuyun.</h2>
					<h2>Tema Hakkında Notlar;</h2>* Tema dosyalarında kod aralarına kodların ne işe yaradığı ve ne amaçla yazıldığı hakkında açıklama notları girilmiştir.<br>
					** Temayı yükledikten sonra eklentiler bölümünden gerekli eklentileri yüklemelisiniz.(Option Tree)<br>
					*** Anasayfadaki,kategoriye özel sliderlı haber görüntüleme kutusunun kategori ayarını değiştirmek için,<i>görünüm menüsü altından->theme options</i> yoluna girmelisiniz.<br><br><br>
					!* Görünüm Menüsü Altında Theme Options Adındaki Menüde Temaya Özel Bir Çok Özellik Kodlanmıştır. <br><br><br>
					**** Buradaki notları <i>tema-yolu/functions.php</i> içerisinde bulup,değiştirip,silebilirsiniz.<br>
					***** Tema adındakı LT ön eki 
					<span style="color:red;">fatal error</span> oluşturabilecek bazı durumları engellemek amacıyla oluşturulmuştur.<br>
					****** Tema klasörü içerisindeki bazı .php dosyalarının tema ile alakası olmamasına rağmen wordpress mimarisinin düzgün çalışabilmesi için oluşturulmuştur.<br>
					<h2>Haber Botu Hakkında;</h2>Sol tarafta bulunan admin menüsünde en üst kısıma bir haber çekme botu eklenmiştir detaylı anlatımını menüden tıklayarak öğrenebilirsiniz.<br><br>
					 -<b>Murat Aslan</b>



				</p>
			</div>
			<?php
		}
		add_action( 'admin_notices', 'sample_admin_notice__success' );





/****************************************************************************************************

		//özet yazısı ve the_excerpt fonksiyonu için limitleme işlemi

****************************************************************************************************/
function wpdocs_custom_excerpt_length( $length ) {
	return 13;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );





/****************************************************************************************************

		//burada haber botu için admin paneline menü ekledim,ve aşağıda bu sayfanın tasarımını yaptım

*****************************************************************************************************/
add_menu_page('Page title', 'Haber Botu', 'manage_options', 'admin/menu.php', 'haber_botu');
function haber_botu(){
	?>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script type="text/javascript">
			//burada dashboard içerisinde bulunan duyuru kutularını javascript ile gizledim,bot sayfasında çok fazla yer kaplıyordu.
			var x = document.getElementById("gorunurluk");
			var y = document.getElementById("gorunurluk2");
			x.style.display = "none";
			y.style.display = "none";
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2>Haber Botu</h2>
					<form method="POST" action="<?php bloginfo('template_url'); ?>/bot/bot.php">
						<div class="form-group">
							<label for="exampleInputEmail1">Haber Adresi: </label>
							<input required="required" name="haberAdres" placeholder="Örnek Url : https://www.bbc.com/turkce/44218564" type="text" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary">Haber Ekle</button>
					</form>
				</div>
				<div class="col-md-6">
					<h2><span style="font-weight: bold;color:red">NOT: </span>	</h2>
					<small>
						<span style="color:green">Ne işe yarar: </span>aşağıdaki şartlar sağlanıp bot çalıştırıldığında adresini aldığınız haberi blogunuza otomatik olarak ekler. <br><br>
						* Yalnızca "https://www.bbc.com/turkce" adresinden haber çekilebilir.<br>
						** Eklemek istediğiniz haberin linkini kopyalayıp kutucuğa yapıştırıp,haber ekle butonuna basınız.<br>
						***Tek seferde yalnızca 1 haber eklenebilir. <br>
						****BBC Türkçe Adresine Gitmek İçin<a target="blank" href="https://www.bbc.com/turkce"> Tıklayın</a><br>
					</small><br>
					<b style="color:green;">- Murat Aslan | KMYO | Öğr. No: ****</b>
				</div>
			</div>
		</div>
	</body>
	<?php
}


/****************************************************************************************************

		//burada gereksiz ve tema ile uyumsuz olan bileşenleri kaldırdım.

*****************************************************************************************************/

function pasif_widgetler() {
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Media_Gallery');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Meta');

	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Text');

	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Media_Image');
} 

add_action('widgets_init', 'pasif_widgetler' );








