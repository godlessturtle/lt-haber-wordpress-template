<?php 
/*Theme Options*/
function lt_haber_css_options() {

    /* CSS to output */
    $theCSS = '';
	
	//admin oturumu açıkken yukarıda gösterilen admin menüsü ve ona göre yukarıdan menüyü aşağıya alma kodum
	if( is_admin_bar_showing() && ! is_customize_preview() ) {
		
		$theCSS .= '
		.header-area  { top: 32px!important; }
		
		@media (max-width: 992px){
			 .header-area  { top: 32px!important; }
		}
		
		@media (max-width: 768px){
			 .header-area { top: 46px!important; }
		}
		
		@media (max-width: 480px){
			 .header-area  { top: 92px; }
		}
		';

	}
	

	//hexadecimal renk kodlarını rgb kodlarına dönüştürüyorum,burası hazır kod
	function lt_haber_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
	$r = hexdec(substr($hex,0,1).substr($hex,0,1));
	$g = hexdec(substr($hex,1,1).substr($hex,1,1));
	$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);

	return $rgb;
	}

	//renk parlaklığını burada elde ediyorum,burası hazır kod
	function lt_haber_colourBrightness($hex, $percent) {
		// Work out if hash given
		$hash = '';
		if (stristr($hex,'#')) {
			$hex = str_replace('#','',$hex);
			$hash = '#';
		}
		/// HEX TO RGB
		$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
		//// CALCULATE 
		for ($i=0; $i<3; $i++) {
			// See if brighter or darker
			if ($percent > 0) {
				// Lighter
				$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
			} else {
				// Darker
				$positivePercent = $percent - ($percent*2);
				$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
			}
			// In case rounding up causes us to go to 256
			if ($rgb[$i] > 255) {
				$rgb[$i] = 255;
			}
		}
		//// RBG to Hex
		$hex = '';
		for($i=0; $i < 3; $i++) {
			// Convert the decimal digit to hex
			$hexDigit = dechex($rgb[$i]);
			// Add a leading zero if necessary
			if(strlen($hexDigit) == 1) {
			$hexDigit = "0" . $hexDigit;
			}
			// Append to the hex string
			$hex .= $hexDigit;
		}
		return $hash.$hex;
	}

	//Menü renklerinin tema ayarları sayfasından düzenlenmesi
	$menu_arkaplan 			= esc_attr( ot_get_option( 'lt_haber_nav_bg' ) );
    $menu_link 				= esc_attr( ot_get_option( 'lt_haber_nav_item' ) );
    $menu_link_hover 		= esc_attr( ot_get_option( 'lt_haber_nav_itemhover' ) );
	
	if ( $menu_arkaplan !='' ) 		{ $theCSS .= '.header-area{background-color:' . $menu_arkaplan . '!important;}'; }
	if ( $menu_link !='' ) 	{ $theCSS .= '.menu-item a {color:' . $menu_link . '!important;}'; }
	if ( $menu_link_hover !='' ){ $theCSS .= 'li.menu-item a:hover{color:' . $menu_link_hover . '!important;}'; }

	


	// FOOTER OPTIONS
	$lt_footer_bg		= 	esc_attr( ot_get_option( 'lt_haber_footer_bg' ) );
	$lt_footer_baslik	= 	esc_attr( ot_get_option( 'lt_haber_footer_title' ) );
	$lt_footer_metin	= 	esc_attr( ot_get_option( 'lt_haber_footer_metin' ) );

	if ( $lt_footer_bg  !='' ) 	{
		$theCSS .= 'footer.footer-area{ background-color: '.  $lt_footer_bg .'!important; }';
	}	
	if ( $lt_footer_baslik  !='' ) 	{
		$theCSS .= 'div.footer-single-widget h5{ color: '.  $lt_footer_baslik .'!important; }';
	}

	if ( $lt_footer_metin  !='' ) 	{
		$theCSS .= '.copywrite-text.mt-30 p{ color: '.  $lt_footer_metin .'!important; }';
	}

	if ( $lt_footer_metin  !='' ) 	{
		$theCSS .= 'ul.footer-menu.d-flex.justify-content-between>li>a{ color: '.  $lt_footer_metin .'!important; }';
	}
	



    /* Add CSS to style.css */
    wp_add_inline_style( 'lt-haber-custom-style', $theCSS );
	}

add_action( 'wp_enqueue_scripts', 'lt_haber_css_options' );