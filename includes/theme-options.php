<?php
	add_action( 'init', 'lt_haber_custom_theme_options' );
	function lt_haber_custom_theme_options() {
	if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
	return false;

	$lt_haber_saved_settings = get_option( ot_settings_id(), array() );

	$lt_haber_custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),

	'sections'        => array( 
		array(
			'id'		=> 'general',
			'title'		=> esc_html__( 'Genel Ayarlar', 'lt-haber' ),
		),
		array(
			'id'		=> 'homepage-set',
			'title'		=> esc_html__( 'Anasayfa İçerikleri', 'lt-haber' ),
		),
		array(
			'id'		=> 'navigation',
			'title'		=> esc_html__( 'Üst Menü-Nav', 'lt-haber' ),
		),
		array(
			'id'		=> 'error_page',
			'title'		=> esc_html__( '404 Sayfası', 'lt-haber' ),
		),   
		array(
			'id'		=> 'footer_general',
			'title'		=> esc_html__( 'Footer Genel', 'lt-haber' ),
		),
	),// sidebar end

// options start
'settings'  => array(



	
		//PRELOADER  SETTINGS.
		array(
			'id'        => 'lt_haber_pre',
			'label'     => esc_html( 'Preloader Aktiflik', 'lt-haber' ),
			'desc'      => sprintf( esc_html( 'Aktif olduğu durumda sayfa açılmadan önce ekranda bir yükleniyor ikonu belirir.', 'lt-haber' ), '<code>on</code>', '<code>off</code>' ),
			'std'       => 'on',
			'type'      => 'on-off',
			'section'   => 'general',
			'operator'  => 'and'
		),
		
		






		// NAVIGATION SETTINGS
		// static menu
		array(
			'id'          => 'lt_haber_nav_bg',
			'label'       => esc_html__( 'Menü Arkaplan Rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'Menü arkaplanının rengi', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#000',
			'section'     => 'navigation'
		),
		array(
			'id'          => 'lt_haber_nav_item',
			'label'       => esc_html__( 'Menü Link Rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'Menüdeki linklerin renkleri', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#8d8d8d',
			'section'     => 'navigation'
		),
		array(
			'id'          => 'lt_haber_nav_itemhover',
			'label'       => esc_html__( 'Menü Hover Rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'Menünün üzerine fare ile gelince oluşacak renk', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#1919ff',
			'section'     => 'navigation'
		),
		







		// Anasayfa İçerikleri
		// static menu
		array(
			'id'          => 'lt_haber_slider_one',
			'label'       => esc_html__( 'Ana Sayfa Slider (ÜST) içeriği için kategori seçimi', 'lt-haber' ),
			'desc'        => esc_html__( 'Anasayfada bulunan sliderlı haber gösterim kutusunu (ÜST) özel bir kategoriye yönlendirmelisiniz bunun için kategorinin ID numarasını yazmanız yeterlidir.', 'lt-haber' ),
			'type'        => 'text',
			'section'     => 'homepage-set'
		),



		array(
			'id'          => 'lt_haber_slider_two',
			'label'       => esc_html__( 'Ana Sayfa Slider (ALT) içeriği için kategori seçimi', 'lt-haber' ),
			'desc'        => esc_html__( 'Anasayfada bulunan sliderlı haber gösterim kutusunu (ALT) özel bir kategoriye yönlendirmelisiniz bunun için kategorinin ID numarasını yazmanız yeterlidir.', 'lt-haber' ),
			'type'        => 'text',
			'section'     => 'homepage-set'
		),























		// 404 Sayfası
		//404 heading
		array(
			'id'          => 'lt_haber_error_heading_display',
			'label'       => esc_html__( '404 Sayfa Başlığı Görüntülensin Mi?', 'lt-haber' ),
			'desc'        => sprintf( esc_html__( 'Açık: %s Veya Kapalı: %s.', 'lt-haber' ), '<code>on</code>', '<code>off</code>' ),
			'std'         => 'on',
			'type'        => 'on-off',
			'section'     => 'error_page',
			'operator'    => 'and'
		),	  
		array(
			'id'          => 'lt_haber_error_heading',
			'label'       => esc_html__( '404 Sayfa Başlığı', 'lt-haber' ),
			'desc'        => esc_html__( 'Bir hata başlığı yazınız.', 'lt-haber' ),
			'std'         => 'Oops!<br><br>Aradığınız Sayfa Bulunamadı!',
			'type'        => 'text',
			'condition'   => 'lt_haber_error_heading_display:is(on)',
			'section'     => 'error_page'
		),
		
		
		//404 slogan
		array(
			'id'          => 'lt_haber_error_slogan_display',
			'label'       => esc_html__( '404 Sayfası Detaylı Bilgi Göstersin Mi?', 'lt-haber' ),
			'desc'        => sprintf( esc_html__( 'Açık: %s Veya Kapalı: %s.', 'lt-haber' ), '<code>on</code>', '<code>off</code>' ),
			'std'         => 'on',
			'type'        => 'on-off',
			'section'     => 'error_page',
			'operator'    => 'and'
		),
		array(
			'id'          => 'lt_haber_error_slogan',
			'label'       => esc_html__( '404 Sayfası Detaylı Hata Bilgisi', 'lt-haber' ),
			'desc'        => esc_html__( 'Kullanıcının ne yapması gerektiğini anlatan bir sayfa bulunamadı mesajı giriniz.', 'lt-haber' ),
			'std'         => 'Anasayfaya Dönmeyi Deneyebilirsiniz.',
			'type'        => 'text',
			'condition'   => 'lt_haber_error_slogan_display:is(on)',
			'section'     => 'error_page'
		),
		
		























		// FOOTER SETTINGS
		array(
			'id'          => 'lt_haber_footer_bg',
			'label'       => esc_html__( 'Footer arkaplan rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'footer kısmı için arkaplan renk düzenlemesi', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#000',
			'section'     => 'footer_general'
		),

		array(
			'id'          => 'lt_haber_footer_title',
			'label'       => esc_html__( 'Footer başlık rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'footer kısmı için başlık renk düzenlemesi', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#c6c6c6',
			'section'     => 'footer_general'
		),

		array(
			'id'          => 'lt_haber_footer_metin',
			'label'       => esc_html__( 'Footer metin rengi', 'lt-haber' ),
			'desc'        => esc_html__( 'footer kısmı için içeriklerin renk düzenlemesi', 'lt-haber' ),
			'type'        => 'colorpicker',
			'std'		  => '#8d8d8d',
			'section'     => 'footer_general'
		),

	) // end array
);

// end function
	/* allow settings to be filtered before saving */
	$lt_haber_custom_settings = apply_filters( ot_settings_id() . '_args', $lt_haber_custom_settings );
	/* settings are not the same update the DB */
	if ( $lt_haber_saved_settings !== $lt_haber_custom_settings ) {
		update_option( ot_settings_id(), $lt_haber_custom_settings ); 
	}
	/* Lets OptionTree know the UI Builder is being overridden */
	global $ot_has_custom_theme_options;
	$ot_has_custom_theme_options = true;
	}