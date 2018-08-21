<?php get_header(); ?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php if ( is_archive() ): ?>
					<h2 class="section-title"><?php the_archive_title(); ?></h2>
				<?php endif; ?>

				<?php
					global $wp_query;

					$found = $wp_query->found_posts;
					$none  = esc_html__( 'No results found. Please broaden your terms and search again.', 'brittany-light' );
					$one   = esc_html__( 'Just one result found. We either nailed it, or you might want to broaden your terms and search again.', 'brittany-light' );
					$many  = esc_html( sprintf( _n( '%d result found.', '%d results found.', $found, 'brittany-light' ), $found ) );
				?>
				<article class="entry">
					<h1 class="entry-title">
						<?php esc_html_e( 'Search results' , 'brittany-light' ); ?>
					</h1>

					<div class="entry-content">
						<p><?php brittany_light_e_inflect( $found, $none, $one, $many ); ?></p>
						<?php if ( $found < 2 ) {
							get_search_form();
						} ?>
					</div>
				</article>

				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part( 'item', get_post_type() ); ?>
				<?php endwhile; ?>

				<?php brittany_light_posts_pagination(); ?>
			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>

			<?php get_template_part( 'part-prefooter' ); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>