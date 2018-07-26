	<?php
		/*
			Template name: Tam Genişlik (Sidebar Yok)
		*/
		
		get_header();  
	?>
	

<div class="regular-page-wrap section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="page-content">
                       <?php 
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();  
								the_content(); 
							endwhile; 
						endif; 
					?>
                    </div>
                </div>
            </div>
        </div>
    </div>	
	<?php get_footer(); ?>