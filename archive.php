	
	<?php 
		get_header();  
		get_template_part('index-header');
	
		$lt_haber_error_heading_v 			= 	ot_get_option( 'lt_haber_error_heading_visibility' ); 
		$lt_haber_error_heading 			= 	ot_get_option( 'lt_haber_error_heading' ); 
		$lt_haber_bread_visibility 		= 	ot_get_option( 'lt_haber_bread' ); 
		$lt_haber_single_disable_heading 	= 	ot_get_option( 'lt_haber_single_disable_heading' ); 
		$lt_haber_archivelayout 			= 	ot_get_option( 'lt_haber_archivelayout' ); 
	
	?>

	<div class="template-cover template-cover-style-2 js-full-height-off section-class-scroll index-header">
		<div class="template-overlay"></div>
		<div class="template-cover-text">
			<div class="container">
				<div class="row">
					<div class="col-md-8 center">
						<div class="template-cover-intro">
							<?php if ( ot_get_option( 'lt_haber_archive_heading_visibility' )!= 'off') : ?>
								<?php if ( ot_get_option( 'lt_haber_archive_heading' )!= '') : ?>
									<h2 class="uppercase lead-heading"><?php echo ( ot_get_option( 'lt_haber_archive_heading' )); ?></h2> 
								<?php else : ?>
									<h2 class="uppercase lead-heading"><?php echo esc_html_e('Arşiv','lt-haber');?></h2>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ot_get_option( 'lt_haber_archive_slogan_visibility' )!= 'off') : ?>	
								<?php if ( ot_get_option( 'lt_haber_archive_slogan' )!= '') : ?>
									<h2 class="cover-text-sublead"><?php echo ( ot_get_option( 'lt_haber_archive_slogan' )); ?></h2> 
								<?php else : ?>
									<h2 class="cover-text-sublead"><?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?></h2>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ( $lt_haber_bread_visibility  ) != 'off') : ?>
								<?php if( function_exists('bcn_display') ) : ?>
									<p class="breadcrubms"> <?php  bcn_display();  ?></p>
								<?php endif; ?>
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
			
				<?php if( ( $lt_haber_archivelayout ) == 'right-sidebar' || ( $lt_haber_archivelayout ) == '' ) { ?>
				<div class="col-lg-8  col-md-8 col-sm-12 index float-right posts">
				<?php } elseif( ( $lt_haber_archivelayout ) == 'left-sidebar') { ?>
				<?php get_sidebar(); ?>
				<div class="col-lg-8  col-md-8 col-sm-12 index float-left posts">
				<?php } elseif( ( $lt_haber_archivelayout ) == 'full-width') { ?>
				<div class="col-xs-12 full-width-index v">
				<?php } ?>
				
				 <?php 
					if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
						get_template_part( 'post-format/content', get_post_format() );
					endwhile;
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'lt-haber' ),
						'next_text'          => esc_html__( 'Next page', 'lt-haber' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lt-haber' ) . ' </span>',
					) );
					else :
						get_template_part( 'content', 'none' );
					endif;
				?>
				
				</div><!-- #end sidebar+ content -->
				
				<?php if( ( $lt_haber_archivelayout ) == 'right-sidebar' || ( $lt_haber_archivelayout ) == '' ) { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
				
				</div>
			</div>
		</div>
	</section>
	
	<?php get_footer(); ?>