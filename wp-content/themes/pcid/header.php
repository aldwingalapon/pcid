<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<html>
<head>
	<meta charset="utf-8" />
	<?php $blogname = get_bloginfo('name'); $blogdesc = get_bloginfo('description'); ?>
	<title><?php wp_title(' - ','true','right'); ?><?php echo (($blogname && $blogdesc) ? $blogname . ' - ' . $blogdesc : $blogname); ?></title>
	<!--[if IE]>
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/ie.css" rel="stylesheet" type="text/css" media="all" />
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.min.css" />

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/owl.carousel.css" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/animate.css" />
	<link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/lightbox.css" />
	<link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/modal.css" />

	<!-- Vegas Background Slideshow -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/vegas.min.css">

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/layout.css" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.ico" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-180x180.png" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-194x194.png" sizes="194x194" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/android-chrome-192x192.png" sizes="192x192" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png" sizes="16x16" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="description" content="The UPVI Silver Jubilarian Class of ‘92 as lead, and in coordination with the National Chess Federation of the Philippines (NCFP), will organize the first U.P. Vanguard Rapid and Blitz Chess Open Tournament from 29 March to 2 April 2017 in the UP DMST Complex, Diliman, Quezon City." />
	<meta name="keywords" content="up vanguard, homecoming activity, 95th homecoming celebration, punch your clock, ncfp, class hinirang 92, rapid and blitz chess, open tournament up vanguard rapid & blitz chess open tournament, march 29 - april 2" />
	<meta name="robots" content="noimageindex, noodp, noydir" />
	<meta name="author" content="Aldwin Llacuna Galapon, JA Media Solutions, February 2017" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
</head>
<body <?php id_the_body(); ?><?php class_the_body(); ?>>
	<div id="wrapper">
		<a href="#" class="smooth-scroll"><button type="button" class="back_to_top-button"><i class="fa fa-chevron-up"></i></button></a>
		<div id="header_overlay"></div>
		<header id="main_header">
			<div class="top_header_utility">
				<div class="container">
					<div class="row">
						<div class="col-md-12 utility">
							<?php wp_nav_menu( array( 'theme_location' => 'utility_navigation', 'items_wrap' => '<ul class="utility-menu">%3$s</ul>', 'link_before' => '<span class="utility_nav_item">', 'link_after'  => '</span>' ) ); ?>
							<form role="search" method="get" id="menu_searchform" class="search-form collapse" action="<?php echo home_url( '/' ); ?>">
								<input type="search" class="search-field" placeholder="<?php echo esc_attr_x((($blogname && $blogdesc) ? 'Search the ' . $blogname . ' - ' . $blogdesc . ' website' : 'Search the ' . $blogname . ' website'), 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" /><input type="hidden" name="search-type" value="all">
							</form>
						</div>
						<div class="clearfix clear"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="top_header">
				<div class="container">
					<div class="row">
						<div class="col-md-2 column-logo">
							<a href="<?php echo get_settings('home'); ?>" title="<?php echo (($blogname && $blogdesc) ? $blogname . ' - ' . $blogdesc : $blogname); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header-logo@3x.png" title="<?php echo (($blogname && $blogdesc) ? $blogname . ' - ' . $blogdesc : $blogname); ?>" alt="<?php echo (($blogname && $blogdesc) ? $blogname . ' - ' . $blogdesc : $blogname); ?>" width="160" height="160" /></a>
							<button class="c-hamburger c-hamburger--htx"><span>toggle menu</span></button>
						</div>
						<div class="col-md-10 column-nav">
							<div id="primary_navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'items_wrap' => '<ul class="primary-menu">%3$s</ul>', 'container' => '' ) ); ?>
							</div>
						</div>
						<div class="clearfix clear"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_header">
				<div class="container">
					<div class="row">
						<div class="clearfix clear"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</header>