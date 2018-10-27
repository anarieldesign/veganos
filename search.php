<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Veganos
 */

get_header(); ?>
<div class="wrap">
	<?php
	if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'veganos' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	<section class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="flexcontainer">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-excerpt.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'excerpt' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>
		</div><!-- .flexcontainer -->

		</main>
	</section>
</div><!-- .wrap -->
<?php
get_footer();
