<?php get_header(); ?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php while ( have_posts() ): the_post(); ?>
					<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="entry-thumb">
								<a class="ci-lightbox" href="<?php echo esc_url( brittany_light_get_image_src( get_post_thumbnail_id(), 'large' ) ); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="entry-meta">
							<time class="entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

							<div class="entry-categories">
								<?php the_category( ', ' ); ?>
							</div>

							<a href="<?php echo esc_url( get_comments_link() ); ?>" class="entry-comments-no"><?php comments_number(); ?></a>
						</div>

						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1>

						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>

						<div class="row-table">
							<div class="row-table-left">
								<div class="entry-tags">
									<?php the_tags( '' ); ?>
								</div>
							</div>
						</div>

						<?php get_template_part( 'part-related' ); ?>

						<?php comments_template(); ?>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>

			<?php get_template_part( 'part-prefooter' ); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>