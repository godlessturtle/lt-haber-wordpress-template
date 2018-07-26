<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage lt_haber
 * @since lt_haber 1.0
 */
?>


<!-- ARTICLE -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="content-container post-container">
		
		<div class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
		</div><!-- .entry-header -->

		<ul class="entry-meta">
			<li> <?php the_time('F j, Y'); ?></li>
			<li><?php the_author(); ?></li>
		</ul>
		
		<?php the_excerpt(); ?>
	
	</div><!-- .entry-footer -->
	
	<!-- Read me BTN -->
	
</article><!-- #post-## -->
