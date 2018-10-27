<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'veganos' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo veganos_get_svg( array( 'icon' => 'bars' ) );
		echo veganos_get_svg( array( 'icon' => 'close' ) );
		esc_html_e( 'Menu', 'veganos' );
		?>
	</button>
	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id' => 'top-menu',
	) ); ?>
</nav><!-- #site-navigation -->
