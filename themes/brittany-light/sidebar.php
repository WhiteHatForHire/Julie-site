<div class="sidebar">
	<?php
		if ( is_page() && is_active_sidebar( 'page' ) ) {
			dynamic_sidebar( 'page' );
		} else {
			dynamic_sidebar( 'blog' );
		}
	?>
</div>
