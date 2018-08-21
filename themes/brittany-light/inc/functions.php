<?php
if ( ! function_exists( 'brittany_light_posts_pagination' ) ):
	/**
	 * Echoes pagination links if applicable. Output depends on pagination method selected from the customizer.
	 *
	 * @uses the_post_pagination()
	 * @uses previous_posts_link()
	 * @uses next_posts_link()
	 *
	 * @param array $args An array of arguments to change default behavior.
	 * @param WP_Query|null $query A WP_Query object to paginate. Defaults to null and uses the global $wp_query
	 *
	 * @return void
	 */
	function brittany_light_posts_pagination( $args = array(), WP_Query $query = null ) {
		$args = wp_parse_args( $args, apply_filters( 'brittany_light_posts_pagination_default_args', array(
			'mid_size'           => 1,
			'prev_text'          => _x( 'Previous', 'previous post', 'brittany-light' ),
			'next_text'          => _x( 'Next', 'next post', 'brittany-light' ),
			'screen_reader_text' => __( 'Posts navigation', 'brittany-light' ),
			'container_id'       => '',
			'container_class'    => '',
		), $query ) );

		global $wp_query;

		if ( ! is_null( $query ) ) {
			$old_wp_query = $wp_query;
			$wp_query     = $query;
		}

		$output = '';
		$method = get_theme_mod( 'pagination_method', 'numbers' );

		if ( $wp_query->max_num_pages > 1 ) {

			switch ( $method ) {
				case 'text':
					$output = get_the_posts_navigation( $args );
					break;
				case 'numbers':
				default:
					$output = get_the_posts_pagination( $args );
					break;
			}

			if ( ! empty( $args['container_id'] ) || ! empty( $args['container_class'] ) ) {
				$output = sprintf( '<div id="%2$s" class="%3$s">%1$s</div>', $output, esc_attr( $args['container_id'] ), esc_attr( $args['container_class'] ) );
			}

		}

		if ( ! is_null( $query ) ) {
			$wp_query = $old_wp_query;
		}

		echo $output;
	}
endif;
