<?php
/**
 * Custom template parts for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lt_haber
*/

// Start menu

if ( ! function_exists( 'lt_haber_menu' ) ) :
	function lt_haber_menu() {
		?>
		<?php 
		wp_nav_menu( array(
			'menu'              => 'primary',
			'theme_location'    => 'primary',
			'depth'             => 3,
			'container'         => '',
			'container_class'   => 'collapse navbar-collapse',
			'menu_class'        => 'navbar-nav ml-auto',
			'menu_id'		    => 'primary-menu',
			'echo' 				=> true,
			'fallback_cb'       => 'lt_haber_Wp_Bootstrap_Navwalker::fallback',
			'walker'            => new lt_haber_Wp_Bootstrap_Navwalker()
		));
		?>


		<?php 
	} 
endif; 

add_action( 'lt_haber_menu_action',  'lt_haber_menu', 10 );



//kategorili slider 1
if ( ! function_exists( 'lt_haber_kategori_slider' ) ) :
	function lt_haber_kategori_slider() {
		?>

		<div class="world-catagory-area">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<?php 
				$sliderKategori = ot_get_option('lt_haber_slider_one');
				if(!$sliderKategori){ $sliderKategori = 1; }
				?>
				<li class="title"><?php echo get_cat_name($sliderKategori); ?><small> Kategorisindeki Haberler</small></li>

				<li class="nav-item">
					<a class="nav-link active" id="tab1" href="<?php bloginfo('url'); ?>/?cat=<?php echo $sliderKategori; ?>" aria-selected="true">Tümünü Gör</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="world-catagory-slider owl-carousel wow fadeInUpBig" data-wow-delay="0.1s">
								<!-- büyük kutu -->
								<?php 

								$args = array(
									'post_type' => 'post',
									'category__in' => $sliderKategori,
									'orderby'   => 'rand',
									'posts_per_page' => 4, 
									'post__not_in' => array($post->ID),
								);
								$the_query = new WP_Query( $args );
								if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
										$the_query->the_post(); ?>
										<div class="single-blog-post">
											<div class="post-thumbnail">
												<img style="height: 157px;object-fit: cover;" src="<?php bloginfo('template_url'); ?>/img/blog-img/b1.jpg" alt="">
												<div class="post-cta"><a href="<?php bloginfo('url'); ?>/?cat=<?php echo get_the_category()[0]->cat_ID; ?>"><?php echo get_the_category()[0]->name; ?></a></div>
											</div>
											<div style="min-height: 255px; max-height: 255px;" class="post-content">
												<a href="<?php the_permalink(); ?>" class="headline">
													<h5><?php echo the_title(); ?></h5>
												</a>
												<p><?php 	echo the_excerpt(); ?></p>
												<div class="post-meta">
													<p><a href="<?php echo bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php echo get_the_author(); ?></a> Tarafından <?php 	echo the_date(); ?> Tarihinde Yazıldı.</p>
												</div>
											</div>
										</div>
									<?php	}
									/* normal post sorgusunu tekrar sıfırlıyoruz. */
									wp_reset_postdata();
								} else {
									echo 'Bu Kategoride Haber Yok,Alanın Özelleştirilmesi Gerek,Öncelikle Bir Kategori Oluşturup Bu Kategoriye Birkaç yazı ekleyin,sonrasında görünüm menüsü altında theme options menüsünden anasayfa içerikleri sekmesini tıklatın ardından kategori ID alanlarını doldurun ve kaydedin.';
								}
								?>
								<!-- büyük kutu -->
							</div>
						</div>

						<!-- küçük kutu -->
						<div class="col-12 col-md-6">
							<?php 
							$args = array(
								'post_type' => 'post',
								'orderby'   => 'rand',
								'category__in' => $sliderKategori,
								'posts_per_page' => 5, 
								'post__not_in' => array($post->ID),
							);
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>
									<div class="single-blog-post post-style-2 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.3s">
										<div class="post-thumbnail">
											<?php if(has_post_thumbnail()){ ?>
												<img src="<?php echo the_post_thumbnail(); ?>
											<?php } else { ?>
												<img src="<?php bloginfo('template_url'); ?>/images/def-img.png">
											<?php } ?>
										</div>
										<div class="post-content">
											<a href="<?php the_permalink(); ?>" class="headline">
												<h5><?php echo the_title(); ?></h5>
											</a>
										</div>
									</div>
								<?php	}
								/* sonraki post döngülerinde oluşturduğumuz args elementlerinin sıkıntı çıkarmaması açısından post sorgusunu sıfırlayıp tekrar normale döndürüyorum. */
								wp_reset_postdata();
							} else {
								echo 'Bu Kategoride Haber Yok,Alanın Özelleştirilmesi Gerek,Öncelikle Bir Kategori Oluşturup Bu Kategoriye Birkaç yazı ekleyin,sonrasında görünüm menüsü altında theme options menüsünden anasayfa içerikleri sekmesini tıklatın ardından kategori ID alanlarını doldurun ve kaydedin.';
							}
							?>
						</div>
						<!-- küçük kutu -->
					</div>
				</div>
			</div>
		</div>

		<?php 
	} 
endif; 

add_action( 'lt_haber_kategori_slider_action',  'lt_haber_kategori_slider', 10 );



//kategorili slider 2
if ( ! function_exists( 'lt_haber_kategori_slider2' ) ) :
	function lt_haber_kategori_slider2() {
		?>
		<div class="world-catagory-area mt-50">
			<ul class="nav nav-tabs" id="myTab2" role="tablist">
				<?php $sliderKategoriAlt = ot_get_option('lt_haber_slider_two');
				if(!$sliderKategoriAlt){ $sliderKategoriAlt = 1; }
				?>
				<li class="title"><?php echo get_cat_name($sliderKategoriAlt); ?> <small>Kategorisindeki Haberler</small></li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php bloginfo('url'); ?>/?cat=<?php echo $sliderKategoriAlt; ?>" aria-selected="true">Tümünü Görüntüle</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent2">
				<div class="tab-pane fade show active" id="world-tab-10" role="tabpanel" aria-labelledby="tab10">
					<div class="row">
						<?php 
						$args = array(
							'post_type' => 'post',
							'orderby'   => 'rand',
							'category__in' => '',
							'posts_per_page' => 2, 
							'post__not_in' => array($post->ID),
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>
								<div class="col-12 col-md-6">
									<div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.2s">
										<div class="post-thumbnail">
											<?php if(has_post_thumbnail()){ ?>
												<img style="    max-height: 224px;" src="<?php echo the_post_thumbnail(); ?>
											<?php } else { ?>
												<img style="    max-height: 224px;" src="<?php bloginfo('template_url'); ?>/images/def-img.png">
											<?php } ?>
											<div class="post-cta"><a href="<?php bloginfo('url'); ?>/?cat=<?php echo get_the_category()[0]->cat_ID; ?>"><?php echo get_the_category()[0]->name; ?></a></div>
										</div>
										<div style="max-height: 210px;min-height: 210px;" class="post-content">
											<a href="<?php echo the_permalink(); ?>" class="headline">
												<h5><?php echo the_title(); ?></h5>
											</a>
											<p><?php $content = the_excerpt(); echo substr($content, 0, 10); ?></p>
											<div class="post-meta">
												<p><a href="<?php echo bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php echo get_the_author(); ?></a> Tarafından <?php 	echo the_date(); ?> Tarihinde Yazıldı.</p>
											</div>
										</div>
									</div>
								</div>
							<?php	}
							/* sonraki post döngülerinde oluşturduğumuz args elementlerinin sıkıntı çıkarmaması açısından post sorgusunu sıfırlayıp tekrar normale döndürüyorum. */
							wp_reset_postdata();
						} else {
							echo 'Bu Kategoride Haber Yok,Alanın Özelleştirilmesi Gerek,Öncelikle Bir Kategori Oluşturup Bu Kategoriye Birkaç yazı ekleyin,sonrasında görünüm menüsü altında theme options menüsünden anasayfa içerikleri sekmesini tıklatın ardından kategori ID alanlarını doldurun ve kaydedin.';
						}
						?>
						<div class="col-12">
							<div class="world-catagory-slider2 owl-carousel wow fadeInUpBig" data-wow-delay="0.4s">
								<div class="single-cata-slide">
									<div class="row">		
										<?php 
										$args = array(
											'post_type' => 'post',
											'orderby'   => 'rand',
											'posts_per_page' => 4, 
											'post__not_in' => array($post->ID),
										);
										$the_query = new WP_Query( $args );
										if ( $the_query->have_posts() ) {
											while ( $the_query->have_posts() ) {
												$the_query->the_post(); ?>
												<div class="col-12 col-md-6">
													<div class="single-blog-post post-style-2 d-flex align-items-center mb-1">
														<div class="post-thumbnail">
															<?php if(has_post_thumbnail()){ ?>
																<img style="    min-height: 90px;" src="<?php echo the_post_thumbnail(); ?>
															<?php } else { ?>
																<img src="<?php bloginfo('template_url'); ?>/images/def-img.png">
															<?php } ?>
														</div>
														<div class="post-content">
															<a href="<?php the_permalink(); ?>" class="headline">
																<h5><?php echo the_title(); ?></h5>
															</a>
															<div class="post-meta">
																<p>Yazar: <a href="<?php bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php echo get_the_author(); ?></a></p>
															</div>
														</div>
													</div>
												</div>
											<?php	}
											/* sonraki post döngülerinde oluşturduğumuz args elementlerinin sıkıntı çıkarmaması açısından post sorgusunu sıfırlayıp tekrar normale döndürüyorum. */
											wp_reset_postdata();
										} else {
											echo 'Bu Kategoride Haber Yok.';
										}
										?>
									</div>
								</div>
								<div class="single-cata-slide">
									<div class="row">
										<?php 
										$args = array(
											'post_type' => 'post',
											'orderby'   => 'rand',
											'posts_per_page' => 4, 
											'post__not_in' => array($post->ID),
										);
										$the_query = new WP_Query( $args );
										if ( $the_query->have_posts() ) {
											while ( $the_query->have_posts() ) {
												$the_query->the_post(); ?>
												<div class="col-12 col-md-6">
													<div class="single-blog-post post-style-2 d-flex align-items-center mb-1">
														<div class="post-thumbnail">
															<?php if(has_post_thumbnail()){ ?>
																<img style="    min-height: 90px;" src="<?php echo the_post_thumbnail(); ?>
															<?php } else { ?>
																<img src="<?php bloginfo('template_url'); ?>/images/def-img.png">
															<?php } ?>
														</div>
														<div class="post-content">
															<a href="<?php the_permalink(); ?>" class="headline">
																<h5><?php echo the_title(); ?></h5>
															</a>
															<div class="post-meta">
																<p>Yazar: <a href="<?php bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php echo get_the_author(); ?></a></p>
															</div>
														</div>
													</div>
												</div>
											<?php	}
											/* sonraki post döngülerinde oluşturduğumuz args elementlerinin sıkıntı çıkarmaması açısından post sorgusunu sıfırlayıp tekrar normale döndürüyorum. */
											wp_reset_postdata();
										} else {
											echo 'Bu Kategoride Haber Yok,Alanın Özelleştirilmesi Gerek,Öncelikle Bir Kategori Oluşturup Bu Kategoriye Birkaç yazı ekleyin,sonrasında görünüm menüsü altında theme options menüsünden anasayfa içerikleri sekmesini tıklatın ardından kategori ID alanlarını doldurun ve kaydedin.';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
	} 
endif; 

add_action( 'lt_haber_kategori_slider2_action',  'lt_haber_kategori_slider2', 10 );
