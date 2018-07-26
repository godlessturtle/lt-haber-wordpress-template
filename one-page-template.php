	<?php
	
		/*
		Template name: One page Template
		*/
		
		get_header();
		
		/* metabox or primary menu options */
		$lt_haber_menu_item_name 	= 	rwmb_meta( 'lt_haber_section_name' );
		$lt_haber_menu_item_url 	= 	rwmb_meta( 'lt_haber_section_url' );
		$lt_haber_menutype 			= 	rwmb_meta( 'lt_haber_menutype' );
	
	?>

	<nav class="template-nav-style-1 nt-theme-header" data-offcanvass-position="template-offcanvass-left">
		<div class="container">
		
			<?php  do_action('lt_haber_logo_action');  ?>
			
			<div class="col-lg-6 col-md-5 col-sm-5 text-center template-link-wrap">
				<?php 
					
					if( $lt_haber_menutype  =='m' &&  $lt_haber_menu_item_name !='' ){
						echo '<ul data-offcanvass="yes" class="primary-menu">';				
						
							foreach (array_combine($lt_haber_menu_item_name, $lt_haber_menu_item_url) as $name => $url) {
								echo '<li><a href="'.esc_url($url).'">'.esc_html($name).'</a></li>';   
							}
						
						echo '</ul>';
					}
				
					if(  $lt_haber_menutype  =='p' ){
						wp_nav_menu( array(
							'menu'              => 'primary',
							'theme_location'    => 'primary',
							'depth'             => 3,
							'container'         => '',
							'container_class'   => '',
							'menu_class'        => 'primary-menu',
							'menu_id'		    => 'primary-menu',
							'echo' 				=> true,
							'fallback_cb'       => 'lt_haber_Wp_Bootstrap_Navwalker::fallback',
							'walker'            => new lt_haber_Wp_Bootstrap_Navwalker()
						));
					}
				?>
			</div>
			
		</div>
	</nav>		

	<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();  
				the_content(); 
			endwhile; 
		endif; 
	?>
	
	<?php get_footer(); ?>