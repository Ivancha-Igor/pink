<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pink graff</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="block-header">
		<div class="header">
			<h1><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo" /></a><?php bloginfo('name'); ?></h1>
			
			<?php wp_nav_menu(array(
				  'container' => false,
				  'theme_location' => 'header_menu' // расположение меню в теме, вывели header_menu
			)); ?>
			
			<a class="log" href=" <?php  wp_login(); ?> ">Login</a>
		</div>
	</div>
