<?php
/**
 * Veganos Theme Customizer.
 *
 * @package Veganos
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function veganos_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Add the Theme Options section
	 */
	$wp_customize->add_panel( 'veganos_options_panel', array(
		'title'          => esc_html__( 'Theme Options', 'veganos' ),
		'description'    => esc_html__( 'Configure your theme settings', 'veganos' ),
	) );
	
	//Hero Options
	$wp_customize->add_section( 'veganos_hero_options', array(
		'title'    => esc_html__( 'Hero Image', 'veganos' ),
		'panel'	  => 'veganos_options_panel',
	) );
	$wp_customize->add_setting( 'veganos_overlay', array(
		'default'           => '0.7',
		'sanitize_callback' => 'veganos_sanitize_overlay',
	) );

	$wp_customize->add_control( 'veganos_overlay', array(
		'label'   => esc_html__( 'Hero Image Opacity', 'veganos' ),
		'section' => 'veganos_hero_options',
		'type'    => 'select',
		'priority'          => 1,
		'choices' => array(
						'0.0' => '0%',
						'0.1' => '10%',
						'0.2' => '20%',
						'0.3' => '30%',
						'0.4' => '40%',
						'0.5' => '50%',
						'0.6' => '60%',
						'0.7' => '70%',
						'0.8' => '80%',
						'0.9' => '90%',
						'1.0' => '100%',
					),
	) );
	
	//Blog Options
	$wp_customize->add_section( 'veganos_blog_layout_options', array(
		'title'           => esc_html__( 'Blog Options', 'veganos' ),
		'panel'	  => 'veganos_options_panel',
	) );
	
	/* Post Display */
	$wp_customize->add_setting( 'veganos_post_type', array(
		'default'           => 'full-lenght',
		'sanitize_callback' => 'veganos_sanitize_choices',
	) );
	$wp_customize->add_control( 'veganos_post_type', array(
		'label'             => esc_html__( 'Blog Page - Post Display', 'veganos' ),
		'section'           => 'veganos_blog_layout_options',
		'settings'          => 'veganos_post_type',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'full-lenght'   => esc_html__( 'Full Length', 'veganos' ),
			'excerpt-lenght'  => esc_html__( 'Excerpt', 'veganos' ),
		)
	) );
	
	/* Post Settings */
	$wp_customize->add_setting( 'veganos_posted_on', array(
		'default'           => false,
		'sanitize_callback' => 'veganos_sanitize_checkbox',
	) );
	$wp_customize->add_control('veganos_posted_on', array(
				'label'      => esc_html__( 'Hide Post Meta', 'veganos' ),
				'section'    => 'veganos_blog_layout_options',
				'settings'   => 'veganos_posted_on',
				'type'		 => 'checkbox',
				'priority'	 => 2
	) );
	
	$wp_customize->add_setting( 'veganos_author_bio', array(
		'default'           => false,
		'sanitize_callback' => 'veganos_sanitize_checkbox',
	) );
	$wp_customize->add_control('veganos_author_bio', array(
		'label'      => esc_html__( 'Hide Author Bio', 'veganos' ),
		'section'           => 'veganos_blog_layout_options',
		'settings'   => 'veganos_author_bio',
		'type'		 => 'checkbox',
		'priority'	 => 3
	) );
	
	/**
	* Adds the individual sections for copyright
	*/
	$wp_customize->add_section( 'veganos_copyright_section' , array(
		'title'    => esc_html__( 'Copyright Settings', 'veganos' ),
		'panel'	  => 'veganos_options_panel',
	) );

	$wp_customize->add_setting( 'veganos_copyright', array(
		'default'           => esc_html__( 'Proudly powered by WordPress. Veganos Theme by Anariel Design. All rights reserved', 'veganos' ),
		'sanitize_callback' => 'veganos_sanitize_text',
	) );
	$wp_customize->add_control( 'veganos_copyright', array(
		'label'             => esc_html__( 'Copyright text', 'veganos' ),
		'section'           => 'veganos_copyright_section',
		'settings'          => 'veganos_copyright',
		'type'		        => 'text',
		'priority'          => 1,
	) );

	$wp_customize->add_setting( 'hide_copyright', array(
		'sanitize_callback' => 'veganos_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'hide_copyright', array(
		'label'             => esc_html__( 'Hide copyright text', 'veganos' ),
		'section'           => 'veganos_copyright_section',
		'settings'          => 'hide_copyright',
		'type'		        => 'checkbox',
		'priority'          => 2,
	) );
	
		
	/**
	* Color Settings
	*/
	$wp_customize->add_section( 'veganos_color_settings', array(
		'title'           => esc_html__( 'Colors', 'veganos' ),
	) );
	
	/* Accent Color */
	$wp_customize->add_setting( 'veganos_colors_accent', array(
		'default'           => '#3a8014',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'veganos_colors_accent', array(
		'label'             => esc_html__( 'Accent Color', 'veganos' ),
		'description'       => esc_html__( 'Change the main accent color', 'veganos' ),
		'settings'          => 'veganos_colors_accent',
		'section'           => 'veganos_color_settings',
		'priority'          => 1,
	) ) );
}
add_action( 'customize_register', 'veganos_customize_register' );


/**
 * Sanitize a numeric value
 */
function veganos_sanitize_numeric_value( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	} else {
		return 0;
	}
}

//Checkboxes
function veganos_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Text
function veganos_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

//Radio Buttons and Select Lists
function veganos_sanitize_choices( $input, $setting ) {
	global $wp_customize;

	$control = $wp_customize->get_control( $setting->id );

	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}
/*
 * Output our custom CSS to change background colour/opacity of panels.
 * Note: not very pretty, but it works.
 */
function veganos_customizer_css( $control ) {
	if ( get_theme_mod( 'veganos_overlay' ) ) :
		?>
			<style type="text/css">
			.overlay-bg {
				opacity: <?php echo esc_attr( get_theme_mod( 'veganos_overlay' ) ); ?>;
			}
			</style>
		<?php
	endif;
}
add_action( 'wp_head', 'veganos_customizer_css' );

/* Sanitize overlay setting */
function veganos_sanitize_overlay( $input ) {

	$choices = array(
					'0.0',
					'0.1',
					'0.2',
					'0.3',
					'0.4',
					'0.5',
					'0.6',
					'0.7',
					'0.8',
					'0.9',
					'1.0',
				);

	if ( ! in_array( $input, $choices ) ) {
		$input = '0.0';
	}

	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function veganos_customize_preview_js() {
	wp_enqueue_script( 'veganos_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'veganos_customize_preview_js' );

/**
 * Some extra JavaScript to improve the user experience in the Customizer for this theme.
 */
function veganos_panels_js() {
	wp_enqueue_script( 'veganos_extra_js', get_template_directory_uri() . '/assets/js/panel-customizer.js', array(), '20151116', true );
}
add_action( 'customize_controls_enqueue_scripts', 'veganos_panels_js' );
