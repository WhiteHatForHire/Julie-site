<?php
add_action( 'customize_register', 'brittany_light_customize_register', 100 );
/**
 * Registers all theme-related options to the Customizer.
 *
 * @param WP_Customize_Manager $wpc Reference to the customizer's manager object.
 */
function brittany_light_customize_register( $wpc ) {

	$wpc->add_section( 'header', array(
		'title'    => esc_html_x( 'Header Options', 'customizer section title', 'brittany-light' ),
		'priority' => 1,
	) );

	$wpc->get_panel( 'nav_menus' )->priority = 2;

	$wpc->add_section( 'layout', array(
		'title'    => esc_html_x( 'Layout Options', 'customizer section title', 'brittany-light' ),
		'priority' => 20,
	) );

	// The following line doesn't work in a some PHP versions. Apparently, get_panel( 'widgets' ) returns an array,
	// therefore a cast to object is needed. http://wordpress.stackexchange.com/questions/160987/warning-creating-default-object-when-altering-customize-panels
	//$wpc->get_panel( 'widgets' )->priority = 55;
	$panel_widgets = (object) $wpc->get_panel( 'widgets' );
	$panel_widgets->priority = 55;

	$wpc->add_section( 'social', array(
		'title'       => esc_html_x( 'Social Networks', 'customizer section title', 'brittany-light' ),
		'description' => esc_html__( 'Enter your social network URLs. Leaving a URL empty will hide its respective icon.', 'brittany-light' ),
		'priority'    => 60,
	) );

	$wpc->add_section( 'single_post', array(
		'title'       => esc_html_x( 'Posts Options', 'customizer section title', 'brittany-light' ),
		'description' => esc_html__( 'These options affect your individual posts.', 'brittany-light' ),
		'priority'    => 70,
	) );

	$wpc->add_section( 'footer', array(
		'title'    => esc_html_x( 'Footer Options', 'customizer section title', 'brittany-light' ),
		'priority' => 100,
	) );

	// Section 'static_front_page' is not defined when there are no pages.
	if ( get_pages() ) {
		$wpc->get_section( 'static_front_page' )->priority = 110;
	}

	$wpc->add_section( 'theme_upgrade', array(
		'title'    => esc_html_x( 'Upgrade to Pro', 'customizer section title', 'brittany-light' ),
		'priority' => 130,
	) );


	//
	// Group options by registering the setting first, and the control right after.
	//

	//
	// Layout
	//
	$wpc->add_setting( 'excerpt_length', array(
		'default'           => 55,
		'sanitize_callback' => 'absint',
	) );
	$wpc->add_control( 'excerpt_length', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'step' => 1,
		),
		'section'     => 'layout',
		'label'       => esc_html__( 'Automatically generated excerpt length (in words)', 'brittany-light' ),
	) );

	$wpc->add_setting( 'excerpt_on_classic_layout', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'excerpt_on_classic_layout', array(
		'type'        => 'checkbox',
		'section'     => 'layout',
		'label'       => esc_html__( 'Show the excerpt.', 'brittany-light' ),
		'description' => esc_html__( 'Applies only on the classic blog layout. If unchecked, the content is displayed instead.', 'brittany-light' ),
	) );

	$wpc->add_setting( 'pagination_method', array(
		'default'           => 'numbers',
		'sanitize_callback' => 'brittany_light_sanitize_pagination_method',
	) );
	$wpc->add_control( 'pagination_method', array(
		'type'    => 'select',
		'section' => 'layout',
		'label'   => esc_html__( 'Pagination method', 'brittany-light' ),
		'choices' => array(
			'numbers' => esc_html_x( 'Numbered links', 'pagination method', 'brittany-light' ),
			'text'    => esc_html_x( '"Previous - Next" links', 'pagination method', 'brittany-light' ),
		),
	) );


	//
	// Header
	//
	$wpc->add_setting( 'header_socials', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'header_socials', array(
		'type'    => 'checkbox',
		'section' => 'header',
		'label'   => esc_html__( 'Show social icons.', 'brittany-light' ),
	) );


	//
	// Footer
	//
	$wpc->add_setting( 'footer_credits', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'footer_credits', array(
		'type'    => 'checkbox',
		'section' => 'footer',
		'label'   => esc_html__( 'Show credits text.', 'brittany-light' ),
	) );

	if ( class_exists( 'null_instagram_widget' ) ) {
		$wpc->add_setting( 'instagram_auto', array(
			'default'           => 1,
			'sanitize_callback' => 'brittany_light_sanitize_checkbox',
		) );
		$wpc->add_control( 'instagram_auto', array(
			'type'    => 'checkbox',
			'section' => 'footer',
			'label'   => esc_html__( 'WP Instagram: Slideshow.', 'brittany-light' ),
		) );

		$wpc->add_setting( 'instagram_speed', array(
			'default'           => 300,
			'sanitize_callback' => 'brittany_light_sanitize_intval_or_empty',
		) );
		$wpc->add_control( 'instagram_speed', array(
			'type'    => 'number',
			'section' => 'footer',
			'label'   => esc_html__( 'WP Instagram: Slideshow Speed.', 'brittany-light' ),
		) );
	}


	//
	// Social
	//
	$wpc->add_setting( 'social_target', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'social_target', array(
		'type'    => 'checkbox',
		'section' => 'social',
		'label'   => esc_html__( 'Open social and sharing links in a new tab.', 'brittany-light' ),
	) );

	$networks = brittany_light_get_social_networks();

	foreach ( $networks as $network ) {
		$wpc->add_setting( 'social_' . $network['name'], array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wpc->add_control( 'social_' . $network['name'], array(
			'type'    => 'url',
			'section' => 'social',
			'label'   => esc_html( sprintf( _x( '%s URL', 'social network url', 'brittany-light' ), $network['label'] ) ),
		) );
	}

	$wpc->add_setting( 'rss_feed', array(
		'default'           => get_bloginfo( 'rss2_url' ),
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wpc->add_control( 'rss_feed', array(
		'type'    => 'url',
		'section' => 'social',
		'label'   => esc_html__( 'RSS Feed', 'brittany-light' ),
	) );


	//
	// Single Post
	//
	$wpc->add_setting( 'single_related_title', array(
		'default'           => esc_html__( 'Related Posts', 'brittany-light' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wpc->add_control( 'single_related_title', array(
		'type'    => 'text',
		'section' => 'single_post',
		'label'   => esc_html__( 'Related Posts section title', 'brittany-light' ),
	) );


	//
	// Theme Upgrade
	//
	$wpc->add_setting( 'upgrade_text', array(
		'default' => '',
	) );
	$wpc->add_control( new Brittany_Light_Customize_Static_Text_Control( $wpc, 'upgrade_text', array(
		'section'     => 'theme_upgrade',
		'label'       => esc_html__( 'Brittany Pro', 'brittany-light' ),
		'description' => array(
			esc_html__( 'Do you enjoy Brittany Light? Upgrade to Pro now and get:', 'brittany-light' ),
			'<ul>' .
				'<li>' . esc_html__( 'Multiple layouts', 'brittany-light' ) . '</li>' .
				'<li>' . esc_html__( 'Infinite style variations', 'brittany-light' ) . '</li>' .
				'<li>' . esc_html__( 'More Customizer options', 'brittany-light' ) . '</li>' .
			'</ul>',
			'<a href="https://www.cssigniter.com/ignite/themes/brittany/" class="customizer-link customizer-upgrade">' . esc_html__( 'Upgrade To Pro', 'brittany-light' ) . '</a>',
			'<a href="https://www.cssigniter.com/docs/brittany-light/" class="customizer-link customizer-documentation">' . esc_html__( 'Documentation', 'brittany-light' ) . '</a>'
		),
	) ) );



	//
	// title_tagline Section
	//
	$wpc->add_setting( 'limit_logo_size', array(
		'default'           => '',
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'limit_logo_size', array(
		'type'        => 'checkbox',
		'section'     => 'title_tagline',
		'priority'    => 8,
		'label'       => esc_html__( 'Limit logo size (for Retina display)', 'brittany-light' ),
		'description' => esc_html__( 'This option will limit the logo size to half its width. You will need to upload your logo in 2x the dimension you want to display it in.', 'brittany-light' ),
	) );

	$wpc->add_setting( 'logo_site_title', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'logo_site_title', array(
		'type'    => 'checkbox',
		'section' => 'title_tagline',
		'label'   => esc_html__( 'Show site title below the logo.', 'brittany-light' ),
	) );

	$wpc->add_setting( 'logo_tagline', array(
		'default'           => 1,
		'sanitize_callback' => 'brittany_light_sanitize_checkbox',
	) );
	$wpc->add_control( 'logo_tagline', array(
		'type'    => 'checkbox',
		'section' => 'title_tagline',
		'label'   => esc_html__( 'Show the tagline below the logo.', 'brittany-light' ),
	) );

	$wpc->add_setting( 'logo_padding_top', array(
		'default'           => '',
		'sanitize_callback' => 'brittany_light_sanitize_intval_or_empty',
	) );
	$wpc->add_control( 'logo_padding_top', array(
		'type'    => 'number',
		'section' => 'title_tagline',
		'label'   => esc_html__( 'Logo top padding', 'brittany-light' ),
	) );

	$wpc->add_setting( 'logo_padding_bottom', array(
		'default'           => '',
		'sanitize_callback' => 'brittany_light_sanitize_intval_or_empty',
	) );
	$wpc->add_control( 'logo_padding_bottom', array(
		'type'    => 'number',
		'section' => 'title_tagline',
		'label'   => esc_html__( 'Logo bottom padding', 'brittany-light' ),
	) );

}

add_action( 'customize_register', 'brittany_light_customize_register_custom_controls', 9 );
/**
 * Registers custom Customizer controls.
 *
 * @param WP_Customize_Manager $wpc Reference to the customizer's manager object.
 */
function brittany_light_customize_register_custom_controls( $wpc ) {
	require get_template_directory() . '/inc/customizer-controls/static-text.php';
}
