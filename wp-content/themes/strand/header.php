<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<!--> 
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="Strand">	

	<!-- HTML5 SHIV -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Force IE to render best possible view -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- FONT -->	
	<!--<script src="//use.typekit.net/fwh2axv.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>-->

	<!-- CSS -->
	<link rel="stylesheet" href="css/vendors/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="css/vendors/bootstrap/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="css/vendors/jquery-ui/jquery-ui.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/style.css" />

	<!-- JS -->
	<script type="text/javascript" src="js/vendors/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/vendors/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/vendors/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/plugins/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="js/plugins/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />	
		
	<!-- ICONS -->
	<!-- <link rel="shortcut icon" href="img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72-precomposed.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114-precomposed.png" /> -->

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
