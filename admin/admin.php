<?php

if (!defined('ABSPATH')) {
	exit;
}

/***** Welcome Notice in WordPress Dashboard *****/

if (!function_exists('veganos_admin_notice')) {
	function veganos_admin_notice() {
		global $pagenow, $veganos_version;
		if (current_user_can('edit_theme_options') && 'index.php' === $pagenow && !get_option('veganos_notice_welcome') || current_user_can('edit_theme_options') && 'themes.php' === $pagenow && isset($_GET['activated']) && !get_option('veganos_notice_welcome')) {
			wp_enqueue_style('veganos-admin-notice', get_template_directory_uri() . '/admin/admin-notice.css', array(), $veganos_version);
			veganos_welcome_notice();
		}
	}
}
add_action('admin_notices', 'veganos_admin_notice');

/***** Hide Welcome Notice in WordPress Dashboard *****/

if (!function_exists('veganos_hide_notice')) {
	function veganos_hide_notice() {
		if (isset($_GET['veganos-hide-notice']) && isset($_GET['_veganos_notice_nonce'])) {
			if (!wp_verify_nonce($_GET['_veganos_notice_nonce'], 'veganos_hide_notices_nonce')) {
				wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'veganos'));
			}
			if (!current_user_can('edit_theme_options')) {
				wp_die(esc_html__('You do not have the necessary permission to perform this action.', 'veganos'));
			}
			$hide_notice = sanitize_text_field($_GET['veganos-hide-notice']);
			update_option('veganos_notice_' . $hide_notice, 1);
		}
	}
}
add_action('wp_loaded', 'veganos_hide_notice');

/***** Content of Welcome Notice in WordPress Dashboard *****/

if (!function_exists('veganos_welcome_notice')) {
	function veganos_welcome_notice() {
		global $veganos_data; ?>
		<div class="notice notice-success zeko-welcome-notice">
			<a class="notice-dismiss zeko-welcome-notice-hide" href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('veganos-hide-notice', 'welcome')), 'veganos_hide_notices_nonce', '_veganos_notice_nonce')); ?>">
				<span class="screen-reader-text">
					<?php echo esc_html__('Dismiss this notice.', 'veganos'); ?>
				</span>
			</a>
			<p><?php printf(esc_html__('Thanks for choosing Veganos! To get started please make sure you visit our %2$swelcome page%3$s.', 'veganos'), $veganos_data['Name'], '<a href="' . esc_url(admin_url('themes.php?page=charity')) . '">', '</a>'); ?></p>
			<p class="zeko-welcome-notice-button">
				<a class="button" href="<?php echo esc_url(admin_url('themes.php?page=charity')); ?>">
					<?php printf(esc_html__('Get Started with Veganos', 'veganos'), $veganos_data['Name']); ?>
				</a>
			</p>
		</div><?php
	}
}

/***** Theme Info Page *****/

if (!function_exists('veganos_theme_info_page')) {
	function veganos_theme_info_page() {
		add_theme_page(esc_html__('Welcome to Veganos', 'veganos'), esc_html__('Theme Info', 'veganos'), 'edit_theme_options', 'charity', 'veganos_display_theme_page');
	}
}
add_action('admin_menu', 'veganos_theme_info_page');

if (!function_exists('veganos_display_theme_page')) {
	function veganos_display_theme_page() {
		global $veganos_data; ?>
		<div class="theme-info-wrap">
			<h1>
				<?php printf(esc_html__('Welcome to Veganos', 'veganos')); ?>
			</h1>
			<div class="zeko-row theme-intro clearfix">
				<div class="zeko-col-1-4">
					<img class="theme-screenshot" src="<?php echo esc_url(get_template_directory_uri() ); ?>/screenshot.png" alt="<?php esc_attr_e('Theme Screenshot', 'veganos'); ?>" />
				</div>
				<div class="zeko-col-3-4 theme-description">
					<p class="about">
						<?php printf(esc_html__('Veganos is a wonderfully designed, clean and responsive free WordPress theme. It is perfect for creating food-related websites like recipe websites, blogs, magazines and more. Veganos is built mobile first and is pleasure to view on devices of all sizes. It features modern, easy-to-read typography and minimalistic design.', 'veganos')); ?>
					</p>
				</div>
			</div>

			<hr>
			<div class="theme-links clearfix">
				<p>
					<strong><?php esc_html_e('Important Links:', 'veganos'); ?></strong>
					<a href="<?php echo esc_url('http://www.anarieldesign.com/free-food-blogger-wordpress-theme/'); ?>">
						<?php esc_html_e('Theme Info Page', 'veganos'); ?>
					</a>
					<a href="<?php echo esc_url('http://www.anarieldesign.com/showcase/'); ?>">
						<?php esc_html_e('Anariel Design Themes Showcase', 'veganos'); ?>
					</a>
				</p>
			</div>
			<hr>
			<div id="getting-started" class="bg">
				<h3>
					<?php printf(esc_html__('Get Started with %s', 'veganos'), $veganos_data['Name']); ?>
				</h3>
				<div class="zeko-row clearfix">
					<div class="zeko-col-1-2">
						<div class="section">
							<h4>
								<span class="dashicons dashicons-welcome-learn-more"></span>
								<?php esc_html_e('Theme Documentation', 'veganos'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Please check the documentation to get better overview of how the theme is structured.', 'veganos'), $veganos_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('http://www.anarieldesign.com/documentation/veganos/'); ?>" class="button button-secondary">
									<?php esc_html_e('Theme Documentation', 'veganos'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<span class="dashicons dashicons-admin-appearance"></span>
								<?php esc_html_e('Theme Options', 'veganos'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Click "Customize" to open the Customizer.',  'veganos'), $veganos_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary">
									<?php esc_html_e('Customize Theme', 'veganos'); ?>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="theme-comparison">
				<h3 class="theme-comparison-intro">
					<?php esc_html_e('Upgrade to one of our membership plans and get access to support and 17 premium themes.', 'veganos'); ?>
				</h3>
				<a href="<?php echo esc_url('https://www.anarieldesign.com/pricing/'); ?>" class="upgrade-button">
					<?php esc_html_e('Upgrade Now', 'veganos'); ?>
				</a>

			</div>
			<hr>
			<div class="section bg1">
				<h3>
					<?php esc_html_e('More Themes by Anariel Design', 'veganos'); ?>
				</h3>
				<p class="about">
					<?php printf(esc_html__('Build Your Dream WordPress Site with Premium Niche Themes for Bloggers & Charities',  'veganos'), $veganos_data['Name']); ?>
				</p>
				<a href="<?php echo esc_url('http://www.anarieldesign.com/themes/'); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/anarieldesign-themes.jpg" alt="<?php esc_attr_e('Theme Screenshot', 'veganos'); ?>" /></a>
				<p>
					<a href="<?php echo esc_url('http://www.anarieldesign.com/themes/'); ?>" class="button button-primary advertising">
						<?php esc_html_e('More Themes', 'veganos'); ?>
					</a>
				</p>
			</div>
			<hr>
		</div><?php
	}
}

?>