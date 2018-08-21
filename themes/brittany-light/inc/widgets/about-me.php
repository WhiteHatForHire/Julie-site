<?php
if ( ! class_exists( 'CI_Widget_About' ) ) :
	class CI_Widget_About extends WP_Widget {

		protected $defaults = array(
			'title'           => '',
			'image'           => '',
			'text'            => '',
			'greeting_text'   => '',
			'signature_text'  => '',
			'signature_image' => '',
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Provide information for the blog author, accompanied by a picture.', 'brittany-light' ) );
			$control_ops = array();
			parent::__construct( 'ci-about', $name = esc_html__( 'Theme - About Me', 'brittany-light' ), $widget_ops, $control_ops );
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$text            = $instance['text'];
			$image           = $instance['image'];
			$greeting_text   = $instance['greeting_text'];
			$signature_text  = $instance['signature_text'];
			$signature_image = $instance['signature_image'];

			echo $args['before_widget'];

			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo '<div class="widget-about">';

			if ( $image ) {
				$attachment = wp_prepare_attachment_for_js( $image );

				echo sprintf( '<p class="widget-about-avatar"><img src="%s" alt="%s" /></p>',
					esc_url( brittany_light_get_image_src( $image, 'brittany_light_about' ) ),
					esc_attr( $attachment['alt'] )
				);
			}

			echo wpautop( do_shortcode( wp_kses_post( $text ) ) );

			if ( ! empty( $greeting_text ) || ! empty( $signature_text ) || ! empty( $signature_image ) ) {
				?>
				<div class="entry-signature">
					<?php if ( ! empty( $greeting_text ) ) : ?>
						<p class="entry-signature-greet"><?php echo esc_html( $greeting_text ); ?></p>
					<?php endif; ?>

					<p class="entry-sig-img">
						<?php if ( ! empty( $signature_image ) ) : ?>
							<?php echo wp_get_attachment_image( $signature_image, 'post-thumbnail' ); ?>
						<?php elseif ( ! empty( $signature_text ) ) : ?>
							<?php echo esc_html( $signature_text ); ?>
						<?php endif; ?>
					</p>
				</div>
				<?php
			}

			echo '</div>';

			echo $args['after_widget'];
		} // widget

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']           = sanitize_text_field( $new_instance['title'] );
			$instance['image']           = intval( $new_instance['image'] );
			$instance['text']            = wp_kses_post( $new_instance['text'] );
			$instance['greeting_text']   = sanitize_text_field( $new_instance['greeting_text'] );
			$instance['signature_text']  = sanitize_text_field( $new_instance['signature_text'] );
			$instance['signature_image'] = intval( $new_instance['signature_image'] );

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title           = $instance['title'];
			$image           = $instance['image'];
			$text            = $instance['text'];
			$greeting_text   = $instance['greeting_text'];
			$signature_text  = $instance['signature_text'];
			$signature_image = $instance['signature_image'];

			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'brittany-light' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" /></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Author Image:', 'brittany-light' ); ?></label>
				<div class="ci-upload-preview">
					<div class="upload-preview">
						<?php if ( ! empty( $image ) ) : ?>
							<?php
								$image_url = brittany_light_get_image_src( $image, 'brittany_light_featgal_small_thumb' );
								echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon" title="%s"></a>',
									esc_url( $image_url ),
									esc_attr__( 'Remove image', 'brittany-light' )
								);
							?>
						<?php endif; ?>
					</div>
					<input type="hidden" class="ci-uploaded-id" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_attr( $image ); ?>" />
					<input id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" type="button" class="button ci-media-button" value="<?php esc_attr_e( 'Select Image', 'brittany-light' ); ?>" />
				</div>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'About text:', 'brittany-light' ); ?></label><textarea rows="10" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" class="widefat"><?php echo esc_textarea( $text ); ?></textarea></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'greeting_text' ) ); ?>"><?php esc_html_e( 'Greeting (sign off) text:', 'brittany-light' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'greeting_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'greeting_text' ) ); ?>" type="text" value="<?php echo esc_attr( $greeting_text ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'signature_text' ) ); ?>"><?php esc_html_e( 'Signature text:', 'brittany-light' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'signature_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'signature_text' ) ); ?>" type="text" value="<?php echo esc_attr( $signature_text ); ?>" class="widefat" /></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'signature_image' ) ); ?>"><?php esc_html_e( 'Signature Image:', 'brittany-light' ); ?></label>
				<div class="ci-upload-preview">
					<div class="upload-preview">
						<?php if ( ! empty( $signature_image ) ) : ?>
							<?php
								$image_url = brittany_light_get_image_src( $signature_image, 'brittany_light_featgal_small_thumb' );
								echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon" title="%s"></a>',
									esc_url( $image_url ),
									esc_attr__( 'Remove image', 'brittany-light' )
								);
							?>
						<?php endif; ?>
					</div>
					<input type="hidden" class="ci-uploaded-id" name="<?php echo esc_attr( $this->get_field_name( 'signature_image' ) ); ?>" value="<?php echo esc_attr( $signature_image ); ?>" />
					<input id="<?php echo esc_attr( $this->get_field_id( 'signature_image' ) ); ?>" type="button" class="button ci-media-button" value="<?php esc_attr_e( 'Select Image', 'brittany-light' ); ?>" />
				</div>
			</p>

			<?php
		} // form

	} // class

	register_widget( 'CI_Widget_About' );

endif;