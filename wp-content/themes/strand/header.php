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
	<script src="//use.typekit.net/jyp3xci.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
		
	<!-- ICONS -->
	<!-- <link rel="shortcut icon" href="img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72-precomposed.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114-precomposed.png" /> -->

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<div id="page-wrapper">
		<div id="header-wrapper" class="">
			<header id="main-header" class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="logo-wrapper hidden-xs hidden-sm visible-md visible-lg">
							<a href="<?php echo home_url(); ?>" class="site-logo">
								<img src="<?php echo IMG; ?>/logo/main-logo.png" alt="<?php bloginfo("name"); ?>">
								<span><?php bloginfo("name"); ?></span>
							</a>
						</div>
						<div id="menu-wrapper">
							<nav id="nav-main">
								<?php

									$defaults = array(
										'echo' => true,
										'container' => false,
										'theme_location'  => 'main-menu',
										'menu_class'      => 'main-menu hidden-xs hidden-sm'
									);


									wp_nav_menu($defaults);
								?>								
							</nav>
						</div>					
					</div>
				</div>
			</header>
		</div>
		<div class="reservation-widget">
			<form id="reservation-form" action="" method="POST" role="form">
				<div class="form-group form-border has-feedback">
					<label for="check-in">CHECK IN:</label>
					<input type="text" name="check-in" class="check-in-input" placeholder="DD/MM/YYYY">
					<i class="form-control-feedback"></i>
				</div>
				<div class="form-group form-border has-feedback">
					<label for="check-out">CHECK OUT:</label>
					<input type="text" name="check-out" class="check-out-input" placeholder="DD/MM/YYYY">
					<i class="form-control-feedback"></i>
				</div>
				<div class="form-group">
					<div class="dropdown">
					    <select class="room-type" name="room-type">
					    	<option>Select room type</option>
					    </select>
					</div>
				</div>
				<div class="form-group">
					<div class="small-input">
						<label for="rooms">ROOMS</label>
						<input type="text" name="rooms">
					</div>

					<div class="small-input">
						<label for="adults">ADULTS</label>
						<input type="text" name="adults">
					</div>

					<div class="small-input">
						<label for="children">CHILDREN</label>
						<input type="text" name="children">
					</div>
				</div>

				<button type="submit" class="btn btn-default check-availability">CHECK AVAILABILITY</button>
				<a href="#" class="modify-cancel">Modify / Cancel reservation</a>
			</form>
		</div>