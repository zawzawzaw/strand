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
		<div id="header-wrapper" class="animated slideInDown">
			<header id="main-header" class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="logo-wrapper">
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
										'menu_class'      => 'main-menu'
									);


									wp_nav_menu($defaults);
								?>
								<div class="toggleMenu hidden-lg hidden-md">
									<a href="javascript:void(0)"> 
										<span class="nav-bar"></span> 
										<span class="nav-bar"></span> 
										<span class="nav-bar"></span> 
									</a> 
								</div>							
							</nav>
						</div>					
					</div>
				</div>
			</header>
		</div>
		<div class="reservation-widget">
			<form id="reservation-form" action="<?php echo get_permalink(get_page_by_title('reservations')); ?>" method="POST" role="form" target="_blank">
				<div class="form-group form-border has-feedback">
					<label for="check-in">CHECK IN:</label>
					<input type="text" name="check-in" class="check-in-input" id="checkInDate" placeholder="DD/MM/YYYY" readonly="true">
					<i class="form-control-feedback"></i>
				</div>
				<div class="form-group form-border has-feedback">
					<label for="check-out">CHECK OUT:</label>
					<input type="text" name="check-out" class="check-out-input" id="checkOutDate" placeholder="DD/MM/YYYY" readonly="true">
					<i class="form-control-feedback"></i>
				</div>
				<!-- <div class="form-group">
					<div class="dropdown">
					    <select class="room-type" name="room-type">
					    	<option>Select room type</option>
					    	<?php 
						    	$section_query = new WP_Query('post_type=ptype_room_types&orderby=menu_order&order=ASC&posts_per_page=-1');

								while ($section_query->have_posts()) : $section_query->the_post(); 
									$this_room_type_title = get_the_title();
							?>
									<option value="<?php echo $this_room_type_title; ?>"><?php echo $this_room_type_title; ?></option>
							<?php
								endwhile;
								wp_reset_query(); 
					    	?>
					    </select>
					</div>
				</div> -->
				<div class="form-group" style="text-align:center;">
					<!-- <div class="small-input">
						<label for="rooms">ROOMS</label>
						<input type="text" name="rooms">
					</div> -->

					<div class="small-input">
						<label for="adults">ADULTS</label>
						<input type="text" name="adults" id="adults">
					</div>

					<div class="small-input">
						<label for="children">CHILDREN</label>
						<input type="text" name="children" id="children">
					</div>
				</div>

				<button type="submit" class="btn btn-default check-availability">CHECK AVAILABILITY</button>
				<!-- <a href="#" class="modify-cancel">Modify / Cancel reservation</a> -->
			</form>
		</div>
		<div id="templatemo_content"></div>