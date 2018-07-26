<!-- 


bu sayfada anasayfada bulunan son eklenen yazılar bölümünü tanımladım,index.php dosyasına include edildi ve o şekilde script ve stil kodlarını aldım.



 -->
<div style="max-height: 165px;" class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
	<div class="post-thumbnail">
		<?php if(has_post_thumbnail()){ ?>
			<img style="height: 165px;max-height: 165px;object-fit: cover; min-height: 165px;" src=<?php echo the_post_thumbnail(); ?>
		<?php } else { ?>
			<img style="height: 165px;max-height: 165px;object-fit: cover;min-height: 165px;" src="<?php bloginfo('template_url'); ?>/images/def-img.png">
		<?php } ?>
	</div>
	<div style="max-height: 165px;" class="post-content">
		<a href="<?php echo the_permalink(); ?>" class="headline">
			<h5 style="font-size:15px;"><?php $title = the_title(); echo substr($title,0,20); ?></h5>
		</a>
		<p><?php echo get_the_excerpt(); ?></p>
		<?php  $cat = wp_get_post_categories($post->ID)[1]; ?>
		<div class="post-meta">
			<p>
				Yazar: <a href="<?php bloginfo('url'); ?>/author/<?php echo get_the_author(); ?>" class="post-author"><?php the_author(); ?></a> 
				<b>|</b> 
				Kategori: <a href="<?php bloginfo('url'); ?>/?cat=<?php echo get_the_category($cat)[0]->cat_ID; ?>" class="post-author"><?php echo get_the_category($cat)[0]->name; ?></a> 
				<b>|</b> 
				Tarih: <a href="javascript:void(0);" class="post-date"><?php echo get_the_date(); ?></a>
			</p>
		</div>
	</div>
</div>