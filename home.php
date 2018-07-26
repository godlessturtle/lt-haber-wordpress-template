<?php 
/* Template Name: Home
*/
 ?>



 <!-- wordpress yönetim panelinden oluşturulan sayfaaları aşağıdaki şablon ile temaya uygun şekilde görüntüleyebiliyorum. -->
<?php get_header();  ?>
<div class="main-content-wrapper section-padding-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="single-blog-content mb-100">
					<div class="post-meta">
						<?php
						while ( have_posts() ) : the_post(); ?>
							<h4 style="margin-bottom: -5px;"><?php echo get_the_title(); ?></h4>
							<p><a href="#" class="post-author"><?php the_author(); ?></a> Tarafından <a href="javascript:void(0);" class="post-date"><?php the_date(); ?></a> Tarihinde Oluşturuldu.</p>
						</div>
						<div class="post-content">
							<?php
							get_template_part( 'content', 'page' );
							if ( comments_open() || get_comments_number() ) :
								comments_template(); ?>
						</div>
					<?php endif;
				endwhile;
				?>
			</div>
		</div>
	</div>
	<!-- sidebar dosyasını ekledim. -->
	<?php include 'sidebar.php'; ?>
</div>
</div>
</div>
<?php get_footer(); ?>