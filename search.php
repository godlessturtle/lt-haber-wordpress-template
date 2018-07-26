	
	
	<?php 
		get_header();  
		get_template_part('index-header');
	
		$lt_haber_bread_visibility 			= 	ot_get_option( 'lt_haber_bread'); 
		$lt_haber_search_layout 			= 	ot_get_option( 'lt_haber_searchlayout' ); 
		$lt_haber_search_heading 			= 	ot_get_option( 'lt_haber_search_heading' ); 
		$lt_haber_single_disable_heading 	= 	ot_get_option( 'lt_haber_search_heading_visibility' ); 
		$lt_haber_search_slogan 			= 	ot_get_option( 'lt_haber_search_slogan' ); 
		$lt_haber_single_disable_slogan 	= 	ot_get_option( 'lt_haber_search_slogan_visibility' ); 
	?>
	
	<div class="template-cover template-cover-style-2 js-full-height-off section-class-scroll index-header">
		
		<div class="template-overlay"></div>
		
		<div class="template-cover-text">
			<div class="container">
				<div class="row">
					<div class="col-md-8 center">
						<div class="template-cover-intro">
						
							<?php if ( $lt_haber_single_disable_heading != 'off' ) : ?>
								
								<?php if ( $lt_haber_search_heading != '' ) : ?>
									<h2 class="uppercase lead-heading"><?php echo ( $lt_haber_search_heading ); ?></h2> 
								<?php else : ?>
									<h2 class="uppercase lead-heading"><?php echo esc_html( $wp_query->found_posts ); ?> <?php esc_html_e( 'Search Results Found For', 'lt-haber' ); ?>: "<?php the_search_query(); ?>"</h2>
								<?php endif; ?>
								
							<?php endif; ?>

							<?php if ( $lt_haber_single_disable_slogan != 'off' ) : ?>
							
								<?php if ( $lt_haber_search_slogan != '' ) : ?>
									<h2 class="cover-text-sublead"><?php echo esc_html( $lt_haber_search_slogan ); ?></h2>
								<?php endif; ?>
								
							<?php endif; ?>

							<?php 
								if ( ( $lt_haber_bread_visibility  ) != 'off' && function_exists('bcn_display') ) : 
							 ?>
									<p class="breadcrubms"> <?php  bcn_display();  ?></p>
							<?php endif; ?>
						
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<section id="blog">
		<div class="container has-margin-bottom">
			<div class="row">
				<div class="col-md-12-off has-margin-bottom-off">
				
				<?php if( ( $lt_haber_search_layout ) == 'right-sidebar' || ( $lt_haber_search_layout ) == '' ) { ?>
				<div class="col-lg-8  col-md-8 col-sm-12 index float-right posts">
				
				<?php } elseif( ( $lt_haber_search_layout ) == 'left-sidebar') { ?>
				<?php get_sidebar(); ?>
				<div class="col-lg-8  col-md-8 col-sm-12 index float-left posts">
				
				<?php } elseif( ( $lt_haber_search_layout ) == 'full-width') { ?>
				<div class="col-xs-12 full-width-index v">
				<?php } ?>
				
					<?php 
						if ( have_posts() ) : 
					
							while ( have_posts() ) : the_post();
								get_template_part( 'content', 'search' );
							endwhile;
							the_posts_pagination( array(
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lt-haber' ) . ' </span>',
							) );
							else :
							get_template_part( 'content', 'none' );
							
						endif;
							
						wp_link_pages(); 
					 ?>
					
				</div><!-- #end sidebar+ content -->
					
				<?php 
					if( ( $lt_haber_search_layout ) == 'right-sidebar' || ( $lt_haber_search_layout ) == '') {
						get_sidebar(); 
					} 
				?>
					
				</div>
			</div>
		</div>
	</section>
	
	<?php get_footer(); ?>