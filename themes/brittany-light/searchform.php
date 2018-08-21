<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform" method="get" role="search">
	<div>
		<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'brittany-light' ); ?></label>
		<input type="text" placeholder="<?php echo esc_attr_x( 'Search', 'search box placeholder', 'brittany-light' ); ?>" name="s" value="<?php echo get_search_query(); ?>">
		<button class="searchsubmit" type="submit"><i class="fa fa-search"></i><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'brittany-light' ); ?></span></button>
	</div>
</form>
