<?php get_header(); ?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php if ( is_archive() ): ?>
					<h2 class="section-title"><?php the_archive_title(); ?></h2>
				<?php endif; ?>

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