<!-- header include edildi. -->
<?php get_header();  ?>
<!-- 404 Sayfası -->
 <div class="regular-page-wrap section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="page-content">
                        <center>
                            <?php if(ot_get_option('lt_haber_error_heading') == 'on'){ ?>
                        	<h1><?php echo ot_get_option('lt_haber_error_heading') ?></h1><br>
                        <?php } ?>
                        <?php if(ot_get_option('lt_haber_error_slogan') == 'on'){ ?>
                        	<p><?php echo ot_get_option('lt_haber_error_slogan'); ?></p><br>
                        <?php } ?>
                        	<a href="<?php echo bloginfo('url'); ?>"><button class="btn btn-success">←Anasayfaya Dön</button></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer include edildi. -->
<?php get_footer(); ?>