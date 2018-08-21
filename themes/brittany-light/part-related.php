<?php $related = brittany_light_get_related_posts( get_the_ID(), 4 ); ?>
<?php if ( $related->have_posts() ): ?>
	<div class="entry-section">
		<?php if ( get_theme_mod( 'single_related_title', __( 'Related Posts', 'brittany-light' ) ) ): ?>
			<h3 class="section-title"><?php echo esc_html( get_theme_mod( 'single_related_title', __( 'Related Posts', 'brittany-light' ) ) ); ?></h3>
		<?php endif; ?>

		<div class="row">
			<?php while ( $related->have_posts() ): $related->the_post(); ?>
				<div class="col-md-6">
					<?php get_template_part( 'item-media', get_post_type() ); ?>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>