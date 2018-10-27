<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Veganos
 */

if ( ! function_exists( 'veganos_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function veganos_posted_on() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = esc_html__( ', ', 'veganos' );

	// Let's get a nicely formatted string for the published date
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	
	// Sticky
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . esc_html__( 'Featured', 'veganos' ) . '</span>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Wrap that in a link, and preface it with 'Posted on'
	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'veganos' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	// Get the author name; wrap it in a link
	$byline = sprintf(
		'<span class="byline-prefix">%1$s</span> %2$s',
		esc_html_x( 'by', 'post author', 'veganos' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Check to make sure we have more than one category before writing to page
	// Also, don't show when blog posts appear on static front page
	$categories_list = get_the_category_list( $separate_meta );
	if ( $categories_list && veganos_categorized_blog() && 'posts' !== get_option( 'show_on_front' ) ) {
		$categories_list = sprintf( '<span class="cat-prefix">%1$s</span> %2$s', esc_html_x( 'in', 'prefaces list of categories assigned to the post', 'veganos' ), $categories_list ); // WPCS: XSS OK.
	}

	// Finally, let's write all of this to the page
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	// Make sure $categories actually exists before trying to echo.
	if ( $categories_list ) {
		echo '<span class="cat-links"> ' . $categories_list . '</span>'; // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'veganos_edit_post_link' ) ) :
/**
 * Prints the post's edit link
 */
function veganos_edit_post_link() {
	// Display 'edit' link
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'veganos' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


if ( ! function_exists( 'veganos_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function veganos_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = esc_html__( ', ', 'veganos' );

	// Display Tags for posts and portfolio projects
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		the_tags( sprintf( '<span class="tags-links">%s ', esc_html__( 'Tagged', 'veganos' ) ), $separate_meta, '</span>' );
	} else if ( 'jetpack-portfolio' === get_post_type() ) {
		$tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', $separate_meta, '' );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'veganos' ) . '</span>', $tags_list );
		}
	}

	// Display link to comments
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'veganos' ), esc_html__( '1 Comment', 'veganos' ), esc_html__( '% Comments', 'veganos' ) );
		echo '</span>';
	}

	veganos_edit_post_link();
}
endif;


/**
 * Returns an accessibility-friendly link to edit a post or page.
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function veganos_edit_link( $id ) {
	if ( is_page() ) :
		$type = esc_html__( 'Page', 'veganos' );
	elseif ( get_post( $id ) ) :
		$type = esc_html__( 'Post', 'veganos' );
	endif;
	$link = edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %1$s %2$s', 'veganos' ),
			esc_html( $type ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
	return $link;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function veganos_categorized_blog() {
	$category_count = get_transient( 'veganos_categories' );
	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );
		set_transient( 'veganos_categories', $category_count );
	}
	return $category_count > 1;
}
/**
 * Flush out the transients used in twentyseventeen_categorized_blog.
 */
function veganos_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'veganos_categories' );
}
add_action( 'edit_category', 'veganos_category_transient_flusher' );
add_action( 'save_post',     'veganos_category_transient_flusher' );

if ( ! function_exists( 'veganos_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Veganos 1.0
 */
function veganos_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Display an SVG in the theme.
 *
 * Where possible SVG's are included inline. This allows the most flexibility
 * when designing, and removes the need to embed all icons on every page since
 * they are only loaded when needed.
 *
 * @see https://css-tricks.com/pretty-good-svg-icon-system/
 *
 * @param string  $name Icon name.
 * @param boolean $echo Should the svg be printed or returned. If true the SVG
 *                      will be output directly. If false an svg use tag will be
 *                      returned.
 * @return string
 */
function veganos_svg( $name, $echo = true ) {

	$path = get_template_directory() . '/images/' . $name . '.svg';

	/**
	 * If the svg exists, and we are echoing it, then embed the code directly in
	 * the page.
	 */
	if ( $echo ) {

		// Return early if file does not exist.
		if ( ! file_exists( $path ) ) {
			return false;
		}

		require $path;

	/**
	 * If we are not echoing it then we use the <use> tqag to refer to the
	 * combined svg that is embedded in the footer of every page.
	 * The svg icons are included in the page withing the @see veganos_include_svg_icons
	 * function.
	 */
	} else {

		// Generate svg 'use' tag to display the svg.
		// Ensure svg can be found in assets/svg/svg.svg or it will not display.
		$svg = '<svg class="icon icon-' . esc_attr( $name ) . '" aria-hidden="true">';
		$svg .= '<use xlink:href="#' . esc_attr( $name ) . '"></use>';
		$svg .= '</svg>';

		return $svg;

	}

}
