<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Veganos
 */

?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links' ) );
			}
			get_template_part( 'components/footer/site', 'info' );
		?>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
