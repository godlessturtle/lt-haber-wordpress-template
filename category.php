<?php 

/*
	Kategori Sayfası,bir kategoriye özel olan yazıları burada listeliyorum.
*/

 //header include edildi.
 get_header(); ?>
 <div class="main-content-wrapper section-padding-100">
 	<div class="container">
 		<div class="row justify-content-center">
 			<div class="col-12 col-lg-8">
 				<div style="margin-top: -46px;" class="world-latest-articles">
 					<div class="row">
 						<div class="col-12 col-lg-12">
 							<div class="title">
 								<h5>"<?php echo get_the_category()[0]->name; ?>" Etiketindeki Haberler</h5>
 							</div>
 							<!-- bu döngüde query değişkeninde belirttiğim üzere anasayfada 5 adet yeni eklenen gönderi olacağını ve gönderilerin şablonunu içeren post.php dosyasını include ettim  -->
 							<?php $query = new WP_Query( 'posts_per_page=7' ); ?>
 							<?php 
 							if ( $query->have_posts() ) {
 								while ( $query->have_posts() ) {
 									$query->the_post(); ?>
 									<!-- post.php dosyası burada include edildi. -->
 									<?php include 'post.php'; ?>
 								<?php	} } ?>
 							</div>
 						</div>
 					</div>
 				</div>
 				<?php include 'sidebar.php'; ?>
 			</div>

 		
 			<!-- Load More btn -->
 			<div class="row">
 				<div class="col-12">
 					<div class="load-more-btn mt-50 text-center">
 						<a href="#" class="btn world-btn">Load More</a>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!-- footer.php include edildi. -->
 	<?php get_footer(); ?>