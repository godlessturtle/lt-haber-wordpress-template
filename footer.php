<!-- Footer kodlarım burada bulunuyor,index.php ve diğer gerekli sayfalara include edip kullanıyorum. -->
<footer class="footer-area">
	<div class="container">
		<div class="row">
			<?php 
			if ( is_active_sidebar( 'lt-haber-footer' ) ) { 
				dynamic_sidebar( 'lt-haber-footer' ); 
			} 
			?>
			<?php 
			if ( is_active_sidebar( 'lt_haber_footer_widget1' ) ) { 
				dynamic_sidebar( 'lt_haber_footer_widget1' ); 
			} 
			?>
			<?php 
			if ( is_active_sidebar( 'lt_haber_footer_widget2' ) ) { 
				dynamic_sidebar( 'lt_haber_footer_widget2' ); 
			} 
			?>

		</div>
	</div>
</footer>
<script src="<?php bloginfo('template_url'); ?>/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="<?php bloginfo('template_url'); ?>/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
<!-- Active js -->
<script src="<?php bloginfo('template_url'); ?>/js/active.js"></script>

</body>

</html>
<?php wp_footer(); ?>