<?php get_header();  ?>
<!--

tekil yazıları görüntüleyecek sayfa şablonu ve ilgili wordpress döngüleri

-->
<div class="main-content-wrapper section-padding-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-8">
				<div class="single-blog-content mb-100">
					<!-- Tekil Yazı Döngüsü -->
					<?php 
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post(); ?>
							<div class="post-meta">
								<h2><?php echo the_title(); ?></h2>
								<p>
									<b>Yazar: </b><a href="<?php bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php the_author(); ?></a> <b>|</b> 
									<b>Kategori: </b><a href="<?php echo bloginfo('url'); ?>?cat=<?php echo get_the_category()[0]->cat_ID; ?>" class="post-datee"><?php echo get_the_category()[0]->name; ?></a> <b> | </b>
									<b>Tarih: </b><?php echo the_date(); ?>

								</p>
							</div>
							<div class="post-content">
								<?php if(has_post_thumbnail()){ ?>
									<img style="width: 100%;height: 275px;object-fit: cover;" src="<?php echo the_post_thumbnail(); ?>
								<?php }?>
								<?php echo '<br>'; ?>
								<h6 style="padding-top:20px;"><?php echo the_content(); ?></h6>
								<ul class="post-tags">
									<?php if(!empty(wp_get_post_tags($post->ID))){ ?>
										<li style="margin-top: 6px;"><h6>Etiketler: </h6></li>
										<?php $count = count(wp_get_post_tags($post->ID)); ?>
										<?php for($i=0;$i<$count;$i++){ ?>
											<li><a href="javascript:void(0);">
												<?php echo wp_get_post_tags($post->ID)[$i]->name; ?>
											</a></li>
										<?php }  } ?>
									</ul>
									<div class="post-meta second-part">
										<p><a href="<?php bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php the_author(); ?></a> Tarafından <?php echo get_the_date(); ?> Tarihinde <a href="<?php echo bloginfo('url'); ?>?cat=<?php echo get_the_category()[0]->cat_ID; ?>" class="post-date"><?php echo get_the_category()[0]->name; ?></a> Kategorisinde Oluşturuldu.</p>
									</div>
								</div>
							<?php	}
						}
						?>


						<!-- Burada benzer haberler kısmını ekledim. -->
						<?php $tags = wp_get_post_tags($post->ID);
						$ilk_etiket = $tags[0]->term_id;
						$args=array(
							'tag__in' => array($ilk_etiket),
							'post__not_in' => array($post->ID),
							'posts_per_page'=>2,
							'caller_get_posts'=>1
						);
						$my_query = new WP_Query($args);
						if ($tags) { ?>
							<?php if($my_query){ ?>
								<center><br>
									<h4>Benzer Haberler</h4><br>
								</center>
							<?php } ?>
							<?php
							if( $my_query->have_posts() ) {
								while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<div class="single-blog-post">
										
											<div class="post-thumbnail">
												<?php if(has_post_thumbnail()){ ?>
												<img style="height: 192px;object-fit: cover;" src="<?php echo the_post_thumbnail(); ?>
											<?php } else{ ?>
												<img style="height: 192px;object-fit: cover;" src="<?php echo bloginfo('template_url');?>/images/single-def.png">
											<?php } ?>
												<div class="post-cta"><a href="<?php echo bloginfo('url'); ?>?cat=<?php echo get_the_category()[0]->cat_ID; ?>"><?php echo get_the_category()[0]->name; ?></a></div>
											</div>
										
										<div class="post-content">
											<a href="<?php echo the_permalink(); ?>" class="headline">
												<h5><?php echo the_title(); ?></h5>
											</a>
											<p><?php echo substr(the_excerpt(),0,10); ?></p>
											<div class="post-meta">
												<p><a href="<?php echo bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php echo get_the_author(); ?></a> Tarafından <?php echo the_date(); ?> Tarihinde Yazıldı.</p>
											</div>
										</div>
									</div>
									<?php
								endwhile;
							}
							wp_reset_query();
						}
						?>
					</div>
				</div>
				<?php include 'sidebar.php'; ?>
			</div>
		</div>
		<?php get_footer(); ?>
