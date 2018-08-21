<?php

add_action( 'wp_head', 'brittany_light_customizer_css' );
if( ! function_exists( 'brittany_light_customizer_css' ) ):
function brittany_light_customizer_css() {
    ?><style type="text/css"><?php

		//
		// Logo
		//
		if ( get_theme_mod( 'logo_padding_top' ) || get_theme_mod( 'logo_padding_bottom' ) ) {
			?>
			.site-logo {
				<?php if( get_theme_mod( 'logo_padding_top' ) ): ?>
					padding-top: <?php echo intval( get_theme_mod( 'logo_padding_top' ) ); ?>px;
				<?php endif; ?>
				<?php if( get_theme_mod( 'logo_padding_bottom' ) ): ?>
					padding-bottom: <?php echo intval( get_theme_mod( 'logo_padding_bottom' ) ); ?>px;
				<?php endif; ?>
			}
			<?php
		}
	?></style><?php
}
endif;
