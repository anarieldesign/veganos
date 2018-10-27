<?php
/**
 * The template for displaying Author bios
 *
 * @package Veganos
 * @since Veganos 1.0
 */
?>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
<div class="entry-author">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Zeko Lite 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$veganos_author_bio_avatar_size = apply_filters( 'veganos_author_bio_avatar_size', 56 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $veganos_author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title"><?php esc_html_e( 'Published by', 'veganos' ); ?> <span class="author-name"><?php echo get_the_author(); ?></span></h2>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<span><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'veganos' ), get_the_author() ); ?>
			</a></span>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
<?php endif; ?>