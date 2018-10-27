<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function veganos_customizer_custom_css() {
	?>
	<style type="text/css">

		/*--------------------------------------------------------------
		# Accent Color
		--------------------------------------------------------------*/
		.emphasis, .dropcap, a, a:visited, .site-description, .site-description a, .wp-block-pullquote cite, .wp-block-pullquote footer, .wp-block-quote.is-large cite, .wp-block-quote.is-large footer, 
		.wp-block-quote.is-style-large cite, .wp-block-quote.is-style-large footer, .wp-block-quote cite, .wp-block-quote footer, .ab-block-post-grid h2 a:hover, .ab-block-post-grid .ab-block-post-grid-author a,
		.ab-block-post-grid .ab-block-post-grid-author a:hover, .ab-block-testimonial .ab-testimonial-name, .has-strong-green-color, .has-strong-green-background-color, body .bc-cart-item-total-price.bc-cart-item--on-sale, body .bc-product__price--sale,
		body .bc-single-product__rating-reviews a, body .bc-cart-item__remove-button, body .bc-link { color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		button, input[type="button"], input[type="reset"], input[type="submit"], div.wpforms-container-full .wpforms-form input[type=submit], div.wpforms-container-full .wpforms-form button[type=submit], 
		div.wpforms-container-full .wpforms-form .wpforms-page-button, .main-navigation li.color a, .blog .sticky, .archive .sticky, .search .sticky, .bypostauthor::before,
		.site-footer .social-links .icon, body span.bc-product-flag--sale { background:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		hr, .ab-block-post-grid .ab-block-post-grid-link, body .bc-btn, body button.bc-btn, body a.bc-btn, body .entry-content .bc-btn, 
		body .entry-content button.bc-btn, body .entry-content a.bc-btn, body .bigcommerce-cart__item-count, 
		body .bc-account-login__form input[type="submit"], body .bc-product-flag--sale, body .bc-alert--success,
		body .bc-account-login__form input[type=submit][disabled], body .bc-btn[disabled], .entry-content .bc-btn[disabled], 
		body .entry-content a.bc-btn[disabled], body .entry-content button.bc-btn[disabled], 
		body a.bc-btn[disabled], button.bc-btn[disabled] { background-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		.dropcap, { border-right-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		blockquote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-quote.is-large, .wp-block-quote.is-style-large  { border-left-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		{ border-top-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		.main-navigation.toggled a:hover, .main-navigation.toggled a:focus { border-bottom-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		input[type="submit"]:focus, .wp-block-columns.alignfull.has-2-columns img, .wp-block-columns.alignfull.has-3-columns img, .wp-block-columns.alignfull.has-4-columns img, .wp-block-columns.alignfull.has-5-columns img, .wp-block-columns.alignfull.has-6-columns img { border-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		.ab-block-post-grid h2 a:hover { -webkit-box-shadow: inset 0 -2px 0 <?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; } 
		
		.ab-block-post-grid h2 a:hover { box-shadow: inset 0 -2px 0 <?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		.ab-block-post-grid .ab-block-post-grid-author a:hover { -webkit-box-shadow: inset 0 -1px 0 <?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; } 
		
		.ab-block-post-grid .ab-block-post-grid-author a:hover { box-shadow: inset 0 -1px 0 <?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		
		@media screen and (min-width: 60em) {
			.main-navigation a:hover, .main-navigation a:focus, .main-navigation .current-menu-item a, .main-navigation ul ul a:hover, .main-navigation ul ul a:focus, .main-navigation li.color a,
			.main-navigation .sub-menu .current-menu-item a, .main-navigation .sub-menu a:hover { border-bottom-color:<?php echo get_theme_mod( 'veganos_colors_accent' ); ?>; }
		}

	</style>
	<?php
}
add_action( 'wp_head', 'veganos_customizer_custom_css' );
?>