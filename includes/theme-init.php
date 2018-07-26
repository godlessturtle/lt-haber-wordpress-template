<?php
/**
 *
 * @package WordPress
 * @subpackage lt_haber
 * @since lt_haber 1.0
 *
**/

/*************************************************
## Google Fontlarının eklenmesi
*************************************************/

if ( ! function_exists( 'lt_haber_fonts_url' ) ) :
function lt_haber_fonts_url() {
	$fonts_url = '';

	$montserrat 	= 	_x( 'on', 'Montserrat font: on or off', 	'lt-haber' );
	$open_sans 		= 	_x( 'on', 'Open+Sans font: on or off', 		'lt-haber' );

	if ( 'off' !== $montserrat || 'off' !== $open_sans  ) {
		$font_families = array();

		if ( 'off' !== $montserrat )
			$font_families[] = 'Montserrat:400,700';

		if ( 'off' !== $open_sans )
			$font_families[] = 'Open+Sans:300,300i,400,700,700i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
endif;

/*************************************************
## stil ve script dosyaları,wp hook yardımıyla wp_head metodu ile header.php de kullanıyorum.
*************************************************/


function lt_haber_scripts() {

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	/*wordpress varsayılan stil dosyalarının eklenmesi.
	wordpress hook sisteminin yardımıyla header.php de wp_head() methodu ile bunları sayfaya entegre ediyorum. */
	wp_enqueue_style( 'bootstrap', 					get_template_directory_uri() . '/css/bootstrap.min.css',false, '1.0');
	wp_enqueue_style( 'lt-haber-update',  				get_template_directory_uri() . '/css/framework-update.css',false, '1.0');
	wp_enqueue_style( 'lt-haber-fonts-load',  			lt_haber_fonts_url(),array(), '1.0.0' );
	wp_enqueue_style('lt-haber-custom-style',  			get_template_directory_uri() . '/css/framework-custom-style.css',false, '1.0');
	wp_enqueue_style( 'lt-haber-style',					get_stylesheet_uri() );


	/*wordpress varsayılan script dosyalarının eklenmesi.
	wordpress hook sisteminin yardımıyla header.php de wp_head() methodu ile bunları sayfaya entegre ediyorum. */
	wp_enqueue_script('lt-haber-blog-settings', 		get_template_directory_uri() .  '/js/framework-blog-settings.js',array('jquery'), '1.0', true);

	wp_enqueue_script( 'modernizr', 						get_template_directory_uri()  .  '/js/modernizr.min.js',array('jquery'), '2.7.1', false );
	wp_script_add_data('modernizr', 						'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', 							get_template_directory_uri()  .  '/js/respond.min.js',array('jquery'), '1.4.2', false );
	wp_script_add_data('respond', 							'conditional', 'lt IE 9' );

}

add_action( 'wp_enqueue_scripts', 'lt_haber_scripts' );


/*************************************************
## admin stil ve scriptleri
*************************************************/

function lt_haber_admin_style() {

	// Update CSS within in Admin
	wp_enqueue_style( 'lt-haber-custom-admin1', 			get_template_directory_uri().'/css/framework-admin.css');
	wp_enqueue_script('lt-haber-custom-admin',			get_template_directory_uri() . '/js/framework-jquery.custom.admin.js');

}
add_action('admin_enqueue_scripts', 'lt_haber_admin_style');


/*************************************************
## tema eklenti ve ek dosyaları
*************************************************/

	// Metabox plugin check
	if ( ! function_exists( 'rwmb_meta' ) ) {
		function rwmb_meta( $key, $args = '', $post_id = null ) {
			return false;
		}
	}

	// tema css ayarları
	require_once get_template_directory() . '/includes/custom-style.php';

	// diğer tema parçalarını içeren php dosyası
	require_once get_template_directory() . '/includes/template-parts.php';

	// otomatik plugin yükleme eklentisi
	require_once get_template_directory() . '/includes/tgm.php';

	// Option tree controller
	if ( ! class_exists( 'OT_Loader' )){

		function ot_get_option() {
			return false;
		}

	}

	// option tree eklentisi için mecburi menü tanımlamaları
	add_filter( 'ot_show_pages', 		'__return_false' );
	add_filter( 'ot_show_new_layout', 	'__return_false' );

	// option tree için sayfa düzenini içeren php dosyası
	include_once get_template_directory() . '/includes/theme-options.php';

	// tema kişisel css dosyası
	require_once get_template_directory() . '/includes/custom-style.php';



/*************************************************
## Tema kurulum ve diğer ayarlar
*************************************************/

if ( ! isset( $content_width ) ) $content_width = 960;

function lt_haber_theme_setup() {
	add_editor_style ( 'custom-editor-style.css' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );


	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'html5', array( 'search-form' ) );

	add_theme_support( 'post-formats', array('gallery', 'quote', 'video', 'audio'));

	register_nav_menus( array(
		'primary' 			=> 	esc_html__( 'Header Menüsü', 'lt-haber' ),
	) );

}
add_action( 'after_setup_theme', 'lt_haber_theme_setup' );

/*************************************************
## Bileşenler sayfasının özelleştirilip temaya dahil edilmesi.
*************************************************/

function lt_haber_widgets_init() {
	register_sidebar( array(
		'name' 			=> esc_html__( 'Blog Sidebar', 'lt-haber' ),
		'id' 			=> 'sidebar-1',
		'description'   => esc_html__( 'Temadaki sidebar alanı için widgetler buraya konulacak','lt-haber' ),
		'before_widget' => '<div class="sidebar-widget-area">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title">',
		'after_title'   => '</h5>'
	) );
	register_sidebar( array(
		'name' 			=> esc_html__( 'Footer Sol', 'lt-haber' ),
		'id' 			=> 'lt-haber-footer',
		'description'   => esc_html__( '3 Kısımdan oluşan footer kısmının sol bloğuna buradan widget eklenebilir.','lt-haber' ),
		'before_widget' => '<div class="col-md-3"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-head">',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name' 			=> esc_html__( 'Footer Orta', 'lt-haber' ),
		'id' 			=> 'lt_haber_footer_widget1',
		'description'   => esc_html__( '3 Kısımdan oluşan footer kısmının orta bloğuna buradan widget eklenebilir.','lt-haber' ),
		'before_widget' => '<div class="col-md-3"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-head">',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name' 			=> esc_html__( 'Footer Sağ', 'lt-haber' ),
		'id' 			=> 'lt_haber_footer_widget2',
		'description'   => esc_html__( '3 Kısımdan oluşan footer kısmının sağ bloğuna buradan widget eklenebilir.','lt-haber' ),
		'before_widget' => '<div class="col-md-3"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-head">',
		'after_title'   => '</h3>'
	) );

}
add_action( 'widgets_init', 'lt_haber_widgets_init' );

/*************************************************
## burada tgm adlı plugin yardımıyla temaya gerekli olan diğer eklentilerin yüklenmesini zorunlu kılıyorum.
*************************************************/

function lt_haber_register_required_plugins() {

    $plugins = array(
		array(
            'name'         => esc_html__('Visual CSS Style Editor', "lt-haber"),
            'slug'         => 'yellow-pencil-visual-theme-customizer',
        ),
		array(
            'name'         	=> esc_html__('Tema Ayarları Özel Eklentisi', "lt-haber"),
            'slug'         	=> 'option-tree',
            'source'        => get_template_directory() . '/plugins/option-tree.zip',
			'required'     	=> true,
        ),
    );

	$config = array(
		'id'           	   => 'tgmpa',
		'default_path' 	   => '',
		'menu'         	   => 'tgmpa-install-plugins',
		'has_notices'  	   => true,
		'dismissable'  	   => true,
		'dismiss_msg'  	   => '',
		'is_automatic' 	   => true,
		'message'     	   => '',
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'lt_haber_register_required_plugins' );


/*************************************************
## aşağıdaki tamamen hazır kod,bootstrap menülerini wordpress sistemine entegre etmek için kullanılıyor,
Bootstrap NavWalker Eklentisi.
*************************************************/

class lt_haber_Wp_Bootstrap_Navwalker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider item-has-children">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider item-has-children">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header item-has-children') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header item-has-children">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'nav-item';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= 'sub item-has-children';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= $item->url;
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 **/
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class=" ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 **/
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 **/
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__('Menü Ekle','lt-haber') .'</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo ($fb_output);
		}
	}
}

/*************************************************
## yorum sistemi
*************************************************/

	if ( ! function_exists( 'lt_haber_yorumlar' ) ) {
    function lt_haber_yorumlar( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments. ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <p><strong><?php esc_html_e( 'Pingback:', 'lt-haber' ); ?></strong> <?php comment_author_link(); ?></p>
            <?php
            break;
            default :
                // Proceed with normal comments. ?>
                <li id="li-comment-<?php comment_ID(); ?>" class="comments">
                    <div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'clr' ); ?>>
                        <span class="avatar-class">
                            <?php echo get_avatar( $comment, 50 ); ?>
                        </span><!-- .comment-author -->
                        <div class="comment-details clr who-comment">
                            <header class="comment-meta">
                                <cite class="fn name"><?php comment_author_link(); ?></cite>
                                <span class="comment-date">
                                <?php
                                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                        esc_url( get_comment_link( $comment->comment_ID ) ),
                                        get_comment_time( 'c' ),
                                        sprintf( _x( '%1$s', '1: date', 'lt-haber' ), get_comment_date() )
                                    ); ?>
                                </span><!-- .comment-date -->
                            </header><!-- .comment-meta -->
                            <?php if ( '0' == $comment->comment_approved ) : ?>
                                <p class="comment-awaiting-moderation">
                                    <?php esc_html_e( 'Yorumunuz Onaylanmayı Bekliyor.', 'lt-haber' ); ?>
                                </p><!-- .comment-awaiting-moderation -->
                            <?php endif; ?>
                            <div class="comment-content entry clr">
                                <?php comment_text(); ?>
                            </div><!-- .comment-content -->
                            <footer class="comment-footer clr">
                                <?php
                                // Cancel comment link
                                comment_reply_link( array_merge( $args, array(
                                    'reply_text'    => esc_html__( 'Cevapla', 'lt-haber' ) . '',
                                    'depth'         => $depth,
                                    'max_depth'     => $args['max_depth']
                                ) ) ); ?>
                                <?php
                                // Edit comment link
                                edit_comment_link( esc_html__( 'Düzenle', 'lt-haber' ), '<div class="edit-comment">', '</div>' ); ?>
                            </footer>
                        </div><!-- .comment-details -->
                    </div><!-- #comment-## -->
            <?php
            break;
        endswitch;
    }
}