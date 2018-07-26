<?php 
/*
 Template Name: Anasayfa
 Sitenin anasayfası
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
 								<h5>Son Haberler</h5>
 							</div>
 							<!-- bu döngüde query değişkeninde belirttiğim üzere anasayfada 5 adet yeni eklenen gönderi olacağını ve gönderilerin şablonunu içeren post.php dosyasını include ettim  -->
 							<?php $query = new WP_Query( 'posts_per_page=5' ); ?>
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
 					<br><br>
 					<div class="post-content-area mb-50">
 						<!-- Kategorili Slider Parçaları -->

 						<!-- html kodları ve gerekli döngüleri bulunduran kodlar do_action metodu ile sayfaya eklenmiştir,kodları includes/template-parts.php yolunda bulabilirsiniz. -->
 						<?php do_action('lt_haber_kategori_slider_action'); ?>
 						<?php do_action('lt_haber_kategori_slider2_action'); ?>

 						
 					</div>
 				</div>
 				<?php include 'sidebar.php'; ?>
 			</div>
 		</div>
 	</div>
 	<!-- footer.php include edildi. -->
 	<?php get_footer(); ?>