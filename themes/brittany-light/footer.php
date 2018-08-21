	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>

				<div class="col-md-2 col-sm-6">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<div class="col-md-2 col-sm-6">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>

				<div class="col-md-4 col-sm-6">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>

			<?php if ( get_theme_mod( 'footer_credits', 1 ) ) : ?>
				<div class="row">
					<div class="col-md-12">
						<p class="footer-credits">
							<?php echo wp_kses( sprintf( __( '<a href="%1$s">Brittany Light</a> WordPress Theme by CSSIgniter | Proudly powered by <a href="%2$s">WordPress</a>', 'brittany-light' ),
								esc_url( 'https://www.cssigniter.com/ignite/themes/brittany-light/' ),
								esc_url( 'https://wordpress.org/' )
							), brittany_light_get_allowed_tags( 'guide' ) ); ?>
						</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</footer>
</div> <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
