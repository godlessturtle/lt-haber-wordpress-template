<!-- Burası temanın header dosyası gerekli yerlerde include edip kullanıyorum. -->
<!DOCTYPE html>
<html lang="<?php echo language_attributes(); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php if(!is_single() || is_archive()){ ?>
	<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
	<?php } ?>

	<?php if(is_single()){ ?>
		<title><?php echo the_title(); ?></title>
	<?php } ?>

	<?php if(is_archive()){ ?>
		<title>Arşiv: <?php echo get_the_author();  ?> Tarafından Yazılan Yazılar</title>
	<?php } ?>



	<link rel="icon" href="<?php bloginfo('template_url'); ?>/img/core-img/favicon.ico">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css?ver=9">
		<?php wp_head(); ?>
</head>
<body>

	<?php if(ot_get_option('lt_haber_pre') == 'on'){ ?>
	<div id="preloader">
		<div class="preload-content">
			<div id="world-load"></div>
		</div>
	</div> 
<?php } ?>

	<header class="header-area">
		<div class="container">
			<div class="row">
				<div class="col-12">

					<nav class="navbar navbar-expand-lg">
						<!-- Logo -->
						<a class="navbar-brand" href="<?php echo bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
						<!-- Navbar Toggler -->
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
						<!-- Navbar -->
						<div class="collapse navbar-collapse" id="worldNav">
							<?php do_action('lt_haber_menu_action'); ?>
							<!-- Search Form  -->
							
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
