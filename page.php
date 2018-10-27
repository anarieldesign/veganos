<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Veganos
 */

get_header(); ?>

	<div class="front-page-content-area">
		<?php
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$veganos_page_image = $thumb['0'];
		?>
		<div id="hero" class="hero" style="background-image: url(<?php echo esc_url( $veganos_page_image ); ?>);">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'veganos-hero-thumbnail' ); ?>
			<?php endif; ?>
			<div class="wrap hero-container-outer">
			<div class="hero-container-inner">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php veganos_edit_link( get_the_ID() ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
		</div>

		<?php veganos_svg( 'wave' ); ?>

		</div>
	</div><!-- .front-page-content-area -->

<div class="wrap page-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'components/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main>
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php
get_footer();
