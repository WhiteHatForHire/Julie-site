<?php 
if ( ! class_exists( 'CI_Widget_Latest_Posts' ) ) :
	class CI_Widget_Latest_Posts extends WP_Widget {

		protected $defaults = array(
			'title'    => '',
			'category' => '',
			'random'   => '',
			'count'    => 3,
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Displays a number of the latest (or random) posts from a specific category.', 'brittany-light' ) );
			$control_ops = array();
			parent::__construct( 'ci-latest-posts', esc_html__( 'Theme - Latest Posts', 'brittany-light' ), $widget_ops, $control_ops );
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title    = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$category = $instance['category'];
			$random   = $instance['random'];
			$count    = $instance['count'];

			if ( 0 == $count ) {
				return;
			}

			$q_args = array(
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $count,
			);

			if ( 1 == $random ) {
				$q_args['orderby'] = 'rand';
				unset( $q_args['order'] );
			}

			if ( ! empty( $category ) && $category > 0 ) {
				$q_args['cat'] = intval( $category );
			}

			$q = new WP_Query( $q_args );


			if ( $q->have_posts() ) {

				echo $args['before_widget'];

				if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}

				while ( $q->have_posts() ) {
					$q->the_post();
					get_template_part( 'item-media', get_post_type() );
				}
				wp_reset_postdata();

				echo $args['after_widget'];
			}

		} // widget

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']    = sanitize_text_field( $new_instance['title'] );
			$instance['category'] = brittany_light_sanitize_intval_or_empty( $new_instance['category'] );
			$instance['random']   = brittany_light_sanitize_checkbox_ref( $new_instance['random'] );
			$instance['count']    = intval( $new_instance['count'] ) > 0 ? intval( $new_instance['count'] ) : 1;

			return $instance;
		} // save

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title    = $instance['title'];
			$category = $instance['category'];
			$random   = $instance['random'];
			$count    = $instance['count'];

			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'brittany-light' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat"/></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category to display the latest posts from (optional):', 'brittany-light' ); ?></label>
			<?php wp_dropdown_categories( array(
				'taxonomy'          => 'category',
				'show_option_all'   => '',
				'show_option_none'  => ' ',
				'option_none_value' => '',
				'show_count'        => 1,
				'echo'              => 1,
				'selected'          => $category,
				'hierarchical'      => 1,
				'name'              => $this->get_field_name( 'category' ),
				'id'                => $this->get_field_id( 'category' ),
				'class'             => 'postform widefat',
			) ); ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'random' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>" value="1" <?php checked( $random, 1 ); ?> /><?php esc_html_e( 'Show random posts.', 'brittany-light' ); ?></label></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'brittany-light' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $count ); ?>" class="widefat"/></p>
			<?php

		} // form


	} // class

	register_widget( 'CI_Widget_Latest_Posts' );

endif;