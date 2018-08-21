<?php get_header(); ?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<article class="entry entry-404">
					<div class="text-center">
						<h1 class="entry-title">
							<?php esc_html_e( 'Page not found', 'brittany-light' ); ?>
						</h1>

						<p><?php esc_html_e( 'It looks like the page you are looking for is not here. Perhaps try searching?', 'brittany-light' ); ?></p>

						<?php get_search_form(); ?>
					</div>

					<div class="entry-section">
						<h3 class="section-title">
							<?php esc_html_e( "Maybe you're interested in", 'brittany-light' ); ?>
						</h3>

						<?php $q = new WP_Query( array(
							'posts_per_page' => 4
						) ); ?>
						<?php if ( $q->have_posts() ): ?>
							<div class="row">
								<?php while ( $q->have_posts() ): $q->the_post(); ?>
									<div class="col-md-6">
										<?php get_template_part( 'item-media', get_post_type() ); ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</article>
			</div>

			<?php get_template_part( 'part-prefooter' ); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>