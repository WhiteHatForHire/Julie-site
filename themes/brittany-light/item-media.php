<article class="entry-item-media">
	<?php if ( has_post_thumbnail() ): ?>
		<figure class="entry-item-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'brittany_light_square' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="entry-item-media-content">
		<p class="entry-meta">
			<time class="entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</p>

		<h1 class="entry-item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
	</div>
</article>
