<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="page">
	<header class="header">

		<div id="mobilemenu"></div>

		<div class="header-bar">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="header-bar-wrap">
							<div class="header-bar-left">
								<a href="#mobilemenu" class="mobile-nav-trigger"><i class="fa fa-navicon"></i></a>
								<nav class="nav">
									<?php wp_nav_menu( array(
										'theme_location' => 'main_menu',
										'container'      => '',
										'menu_id'        => '',
										'menu_class'     => 'navigation'
									) ); ?>
								</nav><!-- #nav -->
							</div>

							<div class="header-bar-right">
								<?php if ( get_theme_mod( 'header_socials', 1 ) ) {
									get_template_part( 'part-social-icons' );
								} ?>

								<a href="#" class="main-search-trigger"><i class="fa fa-search"></i></a>
							</div>
						</div>

						<div class="header-search-wrap">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="logo-wrap">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">

						<h1 class="site-logo">
							<?php if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							} ?>

							<?php if ( get_theme_mod( 'logo_site_title', 1 ) ): ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-textual">
									<?php bloginfo( 'name' ); ?>
								</a>
							<?php endif; ?>
						</h1>

						<?php if ( get_bloginfo( 'description' ) && get_theme_mod( 'logo_tagline', 1 ) ): ?>
							<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>
