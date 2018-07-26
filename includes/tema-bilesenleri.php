<?php

/*********************************************************************************
*********************************************************************************
*********************************************************************************
*********************************************************************************

Bu sayfada temaya özel sidebar ve footer bileşenleri oluşturulmuştur,kullanmayı bilmiyorsanız değişiklik yapmanızı önermiyorum.

*********************************************************************************
*********************************************************************************
*********************************************************************************
***********************************************************************************/


/*
 	Metin Bileşeni
*/
 	class lt_sidebar_metin_widgeti extends WP_Widget {
 		public function __construct() {
 			$widget_options = array( 'classname' => 'text-widget-sidebar', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış metin widgeti.(yalnızca sidebar için kullabılabilir)' );
 			parent::__construct( 'text-widget-sidebar', 'LT - Metin (Sidebar) ', $widget_options );
 		}
 		public function widget( $args, $instance ) { 
 			$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
 			$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
 			?>
 			<div class="sidebar-widget-area">
 				<h5 class="title"><?php echo esc_html($title); ?></h5>
 				<div class="widget-content">

 					<p><?php echo esc_html($icerik); ?></p>
 				</div>
 			</div>
 		<?php	}
 		public function form( $instance ) {
 			$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
 			?>
 			<p>
 				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
 				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
 				<br>
 				<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
 				?>
 				<label for="<?php echo $this->get_field_id( 'icerik' ); ?>">Metin:</label>
 				<textarea  id="<?php echo $this->get_field_id( 'icerik' ); ?>" name="<?php echo $this->get_field_name( 'icerik' ); ?>">
 					<?php echo esc_html($icerik); ?>
 				</textarea>
 			</p>
 			<?php
 		}	
 		public function update( $new_instance, $old_instance ) {
 			$instance = $old_instance;
 			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
 			$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
 			return $instance;
 		}
 	}
 	function lt_register_sidebar_metin_widget() { 
 		register_widget( 'lt_sidebar_metin_widgeti' );
 	}
 	add_action( 'widgets_init', 'lt_register_sidebar_metin_widget' );



/*
Öne Çıkarılmış Haber Bileşeni
*/
class one_cikarlian_haber_widget extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'text-widget-footer', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış öne çıkarılmış yazı widgeti.(yalnızca sidebar için kullabılabilir)' );
		parent::__construct( 'deneme-widget', 'LT - Öne Çıkarılmış (Sidebar) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		$secilen = get_post($icerik); 
		?>

		<div class="sidebar-widget-area">
			<h5 class="title"><?php echo esc_html($title); ?></h5>
			<div class="widget-content">
				<div class="single-blog-post todays-pick">
					<div class="post-thumbnail">
						<?php if(has_post_thumbnail($secilen->post_id)){ ?>
							<img src="<?php echo the_post_thumbnail(); ?>"
						<?php } else{ ?>
							<img src="<?php echo bloginfo('template_url'); ?>/images/default.jpg">
						<?php } ?>
					</div>
					<!-- Post Content -->
					<div class="post-content px-0 pb-0">
						
						<a href="<?php the_permalink($secilen); ?>" class="headline">
							<h5><?php echo esc_html($secilen->post_title); ?></h5>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
			<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
			?>
			<label for="<?php echo $this->get_field_id( 'icerik' ); ?>">İçerik ID:</label>
			<input value="<?php echo esc_html($icerik); ?>" id="<?php echo $this->get_field_id( 'icerik' ); ?>" name="<?php echo $this->get_field_name( 'icerik' ); ?>"
			/>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function one_cikarilan_haber() { 
	register_widget( 'one_cikarlian_haber_widget' );
}
add_action( 'widgets_init', 'one_cikarilan_haber' );







/*
Soundcloud Widgeti
*/
class lt_haber_soundcloud_Widget extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'soundcloud-widget-sidebar', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış soundcloud müzik paylaşım widgeti.(yalnızca sidebar için kullabılabilir)' );
		parent::__construct( 'soundcloud-widget-sidebar', 'LT - Soundcloud (Sidebar) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		$secilen = get_post($icerik); 
		?>

		<div class="sidebar-widget-area">
			<h5 class="title"><?php echo esc_html($title); ?></h5>
			<div  style="padding: 0px!important" class="widget-content">
				<div class="single-blog-post todays-pick">

					<iframe width="100%" height="150" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=<?php echo esc_url($icerik); ?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
				</div>
			</div>
		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
			<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
			?>
			<label for="<?php echo $this->get_field_id( 'icerik' ); ?>">Soundcloud URL: </label>
			<input value="<?php echo esc_html($icerik); ?>" id="<?php echo $this->get_field_id( 'icerik' ); ?>" name="<?php echo $this->get_field_name( 'icerik' ); ?>"
			/>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function lt_haber_soundcloud() { 
	register_widget( 'lt_haber_soundcloud_Widget' );
}
add_action( 'widgets_init', 'lt_haber_soundcloud' );





/*
Soundcloud Widgeti
*/
class lt_haber_youtube_widget extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'youtube-widget-sidebar', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış youtube video paylaşım widgeti.(yalnızca sidebar için kullabılabilir)' );
		parent::__construct( 'youtube-widget-sidebar', 'LT - Youtube (Sidebar) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		$secilen = get_post($icerik); 
		?>
		<div class="sidebar-widget-area">
			<h5 class="title"><?php echo esc_html($title); ?></h5>
			<div  style="padding: 0px!important" class="widget-content">
				<div class="single-blog-post todays-pick">
					<iframe width="100%" height="150" src="https://www.youtube.com/embed/<?php echo $icerik; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
			<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
			?>
			<label for="<?php echo $this->get_field_id( 'icerik' ); ?>">Video Kimliği: </label>
			<input value="<?php echo esc_html($icerik); ?>" id="<?php echo $this->get_field_id( 'icerik' ); ?>" name="<?php echo $this->get_field_name( 'icerik' ); ?>"
			/>
			<small>* Video kimliği bir youtube videosunun url adresinin sonunda bulunan watch metodunun ?v parametresinin aldığı değer olarak tanımlanmıştır,sadece onu kopyalayıp yukarıdaki kutucupa yapıştırmanız yeterlidir.<br>Örnek Kimlik: <br>https://www.youtube.com/watch?v=</small><b><span style="color:red;">yJpJCZYTL74</span><b>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function lt_haber_youtube() { 
	register_widget( 'lt_haber_youtube_widget' );
}
add_action( 'widgets_init', 'lt_haber_youtube' );








/*
Footer kategoriler widgeti
*/

class lt_footer_kategoriler_widgeti extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'categories-widget-footer', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış kategoriler widgeti.(yalnızca footer için kullabılabilir)' );
		parent::__construct( 'categories-widget-footer', 'LT - Kategoriler(Footer) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		?>
		<div class="col-12 col-md-4">
			<div class="footer-single-widget">
				<h5 style="color:grey"><?php echo $title; ?></h5>
				<ul class="footer-menu d-flex justify-content-between">
					<?php $categories = get_categories(); ?>
					<?php foreach($categories as $cat){ ?>

						<li><a href="<?php echo bloginfo('url'); ?>/?cat=<?php echo $cat->cat_ID; ?>"><?php echo $cat->name; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function lt_register_footer_kategoriler_widgeti() { 
	register_widget( 'lt_footer_kategoriler_widgeti' );
}
add_action( 'widgets_init', 'lt_register_footer_kategoriler_widgeti' );







/*
Footer kategoriler widgeti
*/

class lt_footer_metin_widgeti extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'text-widget-footer', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış metin widgeti.(yalnızca footer için kullabılabilir)' );
		parent::__construct( 'text-widget-footer', 'LT - Metin(Footer) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		?>
		<div class="col-12 col-md-4">
			<div class="footer-single-widget">
				<h5 style="color:grey"><?php echo $title; ?></h5>
				<div class="copywrite-text mt-30">
					<p><?php echo $icerik; ?></p>
				</div>
			</div>

		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
			<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
			?>
			<label for="<?php echo $this->get_field_id( 'icerik' ); ?>">Metin:</label>
			<textarea  id="<?php echo $this->get_field_id( 'icerik' ); ?>" name="<?php echo $this->get_field_name( 'icerik' ); ?>">
				<?php echo esc_html($icerik); ?>
			</textarea>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function lt_register_footer_metin_widgeti() { 
	register_widget( 'lt_footer_metin_widgeti' );
}
add_action( 'widgets_init', 'lt_register_footer_metin_widgeti' );








/*
Footer kategoriler widgeti
*/


class lt_footer_etiketler extends WP_Widget {
	public function __construct() {
		$widget_options = array( 'classname' => 'tags-widget-footer', 'description' => 'LT-Haber Teması için özel olarak tasarlanmış etiketler widgeti.(yalnızca footer için kullabılabilir)' );
		parent::__construct( 'tags-widget-footer', 'LT - Etiketler(Footer) ', $widget_options );
	}
	public function widget( $args, $instance ) { 
		$title = apply_filters( 'text-widget-footer', $instance[ 'title' ] );
		$icerik = apply_filters( 'text-widget-footer', $instance[ 'icerik' ] );
		?>
		<div class="col-12 col-md-4">
			<div class="footer-single-widget">
				<h5><?php echo $title; ?></h5>
				<ul class="footer-menu d-flex justify-content-between">
					<?php $tags = get_tags(); ?>
					<?php foreach($tags as $tag){ ?>
						<li><a href="javascript:void(0);"><?php echo $tag->name; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık:&nbsp;</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			<br>
			<?php	$icerik = ! empty( $instance['icerik'] ) ? $instance['icerik'] : ''; 
			?>
		</p>
		<?php
	}	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icerik' ] = strip_tags( $new_instance[ 'icerik' ] );
		return $instance;
	}
}
function lt_register_footer_etiketler() { 
	register_widget( 'lt_footer_etiketler' );
}
add_action( 'widgets_init', 'lt_register_footer_etiketler' );

?>