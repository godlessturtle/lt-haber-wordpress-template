	
	<?php 
		get_header();  
		get_template_part('index-header');
	
		$lt_haber_bread_visibility 			= 	ot_get_option( 'lt_haber_bread' ); 
		$lt_haber_single_disable_heading 	= 	ot_get_option( 'lt_haber_single_disable_heading' ); 
	?>

	<div class="template-cover template-cover-style-2 js-full-height-off section-class-scroll index-header">

		<div class="template-overlay"></div>
		
		<div class="template-cover-text">
			<div class="container">
				<div class="row">
					<div class="col-md-8 center">
						<div class="template-cover-intro">
						
							<?php if ( ( $lt_haber_single_disable_heading  ) != 'off') : ?>
								<h2 class="uppercase lead-heading"><?php echo the_title();?></h2>
							<?php endif; ?>
								
							<?php if ( ( $lt_haber_bread_visibility  ) != 'off') : ?>
								<?php if( function_exists('bcn_display') ) : ?>
									<p class="breadcrubms"><?php  bcn_display();  ?></p>
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
				<div class="fh5co-project-style-4">
					
					<?php 
						while ( have_posts() ) : 
							the_post(); 
							get_template_part( 'post-format/portfolio/content', get_post_format() ); 
						endwhile; // end of the loop. 
					?>
			
				</div>
			</div>
		</div>
	</section>
	
	<?php get_footer(); ?>
