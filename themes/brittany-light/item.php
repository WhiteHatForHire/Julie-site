<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</figure>
	<?php endif; ?>

	<?php if ( get_post_type() === 'post' ) : ?>
		<div class="entry-meta">
			<time class="entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

			<div class="entry-categories">
				<?php the_category( ', ' ); ?>
			</div>

			<a href="<?php echo esc_url( get_comments_link() ); ?>" class="entry-comments-no"><?php comments_number(); ?></a>
		</div>
	<?php endif; ?>

	<h1 class="entry-title">
		<a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h1>

	<div class="entry-content">
		<?php if ( get_theme_mod( 'excerpt_on_classic_layout', 1 ) ) {
			the_excerpt();
		} else {
			the_content( '' );
		} ?>
	</div>

	<div class="row-table">
		<div class="row-table-left">
			<a href="<?php the_permalink(); ?>"><?php echo wp_kses( __( 'Read More <i class="fa fa-angle-right"></i>', 'brittany-light' ), array( 'i' => array( 'class' => true ) ) ); ?></a>
		</div>
	</div>
</article>