<?php
/**
 * Sidebar kısmı tamamen buradan yönetiliyor,bileşenler menüsünden ekleme/düzenleme yapabilirsiniz.
 *
 * @package WordPress
 * @subpackage lt_haber
 * @since lt_haber 1.0
 */

if (  is_active_sidebar( 'sidebar-1' )  ) : ?>

	<div style="<?php if(is_single()){ ?>margin-top: 39px; <?php } ?>" class="col-12 col-md-8 col-lg-4">
					<div class="post-sidebar-area wow fadeInUpBig" data-wow-delay="0.2s">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				</div>


		
<?php endif; ?>

				