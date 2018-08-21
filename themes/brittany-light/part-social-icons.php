<?php
	$networks = brittany_light_get_social_networks();
	$user     = array();
	$global   = array();
	$used     = array();
	$has_rss  = get_theme_mod( 'rss_feed', get_bloginfo( 'rss2_url' ) ) ? true : false;

	if ( in_the_loop() ) {
		foreach ( $networks as $network ) {
			if ( get_the_author_meta( 'user_' . $network['name'] ) ) {
				$user[ $network['name'] ] = get_the_author_meta( 'user_' . $network['name'] );
			}
		}
	}

	foreach ( $networks as $network ) {
		if ( get_theme_mod( 'social_' . $network['name'] ) ) {
			$global[ $network['name'] ] = get_theme_mod( 'social_' . $network['name'] );
		}
	}

	// Determine whether we should use the user's socials.
	if ( count( $user ) > 0 ) {
		$used = $user;
	} elseif ( count( $global ) > 0 ) {
		$used = $global;
	}

	// Only the content should show the user's socials however.
	if ( ! in_the_loop() ) {
		$used = $global;
	}

	// Set the target attribute for social icons.
	$target = '_self';
	if ( get_theme_mod( 'social_target', 1 ) == 1 ) {
		$target = '_blank';
	}

	if ( ( in_the_loop() && count( $used ) > 0 ) || ( ! in_the_loop() && ( count( $used ) > 0 || $has_rss ) ) ) {
		?>
		<ul class="social-icons">
			<?php
				foreach ( $networks as $network ) {
					if ( ! empty( $used[ $network['name'] ] ) ) {
						echo sprintf( '<li><a href="%s" class="social-icon" target="%s"><i class="fa %s"></i></a></li>',
							esc_url( $used[ $network['name'] ] ),
							esc_attr( $target ),
							esc_attr( $network['icon'] )
						);
					}
				}
			?>
			<?php if ( ! in_the_loop() && $has_rss ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'rss_feed', get_bloginfo( 'rss2_url' ) ) ); ?>" class="social-icon" target="<?php echo esc_attr( $target ); ?>"><i class="fa fa-rss"></i></a></li>
			<?php endif; ?>
		</ul>
		<?php
	}
