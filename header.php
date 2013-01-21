<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width" />

	<!-- Favicon and Feed -->
	<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<!--  iPhone Web App Home Screen Icon -->
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/devices/reverie-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/devices/reverie-icon-retina.png" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/devices/reverie-icon.png" />

	

<?php wp_head(); ?>

</head>

<body <?php body_class('off-canvas hide-extras'); ?>>

	<!-- Start the main container -->
	<div id="container" class="container" role="document">

		<!-- Row for blog navigation -->
		<div class="row top-header">
			<header class="twelve columns" role="banner">
				
				<h1 id="logo" class="columns"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ullerupsogn_logo.png" alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('name'); ?>" /></a></h1>
				
				<nav role="navigation" class="hide-for-small top-nav">
					<?php
						if ( has_nav_menu( 'primary_navigation' ) ):
					    	wp_nav_menu( array(
								'theme_location' => 'primary_navigation',
								'container' =>false,
								'menu_class' => '',
								'echo' => true,
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 0,
								'items_wrap' => '<ul class="nav-bar">%3$s</ul>',
								'walker' => new reverie_walker())
							);
						endif;
						?>
				</nav>
				<p class="show-for-small">
					<a class='sidebar-button button' id="sidebarButton" href="#sidebar-off" >Menu</a>
				</p> 
			</header>
		</div>
		
		<!-- Start Off-Canvas Row -->
		<div class="row">
		
		<!-- Row for main content area -->
		<section id="main" role="main">