<?php
/**
 * Altitude Pro.
 *
 * This file adds the functions to the Altitude Pro Theme.
 *
 * @package Altitude Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/altitude/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'altitude_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function altitude_localization_setup() {
	load_child_theme_textdomain( 'altitude-pro', get_stylesheet_directory() . '/languages' );
}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Includes the WooCommerce setup functions.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the WooCommerce custom CSS if customized.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 1.2.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'altitude_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function altitude_enqueue_scripts_styles() {

	wp_enqueue_script(
		genesis_get_theme_handle() . '-global',
		get_stylesheet_directory_uri() . '/js/global.js',
		[],
		genesis_get_theme_version(),
		true
	);

	wp_enqueue_style( 'dashicons' );

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- see https://core.trac.wordpress.org/ticket/49742
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		null
	);

}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_filter( 'wp_resource_hints', 'altitude_resource_hints', 10, 2 );
/**
 * Add preconnect for Google Fonts.
 *
 * @since 1.5.1
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function altitude_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( genesis_get_theme_handle() . '-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}

add_action( 'after_setup_theme', 'altitude_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.3.0
 */
function altitude_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

// Adds new image sizes.
add_image_size( 'featured-page', 1140, 400, true );

// Unregisters the header right widget area.
unregister_sidebar( 'header-right' );

// Repositions the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );

add_filter( 'body_class', 'altitude_body_classes' );
/**
 * Add additional classes to the body element.
 *
 * @since 1.5.1
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function altitude_body_classes( $classes ) {

	if ( ! genesis_is_amp() ) {
		// Add 'no-js' class to the body class values.
		$classes[] = 'no-js';
	}
	return $classes;

}

add_action( 'genesis_before', 'altitude_js_nojs_script', 1 );
/**
 * Echo out the script that changes 'no-js' class to 'js'.
 *
 * @since 1.5.1
 */
function altitude_js_nojs_script() {

	if ( genesis_is_amp() ) {
		return;
	}

	?>
	<script>
	//<![CDATA[
	(function(){
		var c = document.body.classList;
		c.remove( 'no-js' );
		c.add( 'js' );
	})();
	//]]>
	</script>
	<?php
}

add_filter( 'genesis_skip_links_output', 'altitude_skip_links_output' );
/**
 * Removes skip link for primary navigation and adds a skip link for footer widgets.
 *
 * @since 1.1.0
 *
 * @param array $links The list of skip links.
 * @return array The modified list of skip links.
 */
function altitude_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	return $links;

}

add_filter( 'body_class', 'altitude_secondary_nav_class' );
/**
 * Adds secondary-nav class if secondary navigation is used.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function altitude_secondary_nav_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}

	return $classes;

}

add_action( 'genesis_footer', 'altitude_footer_menu', 7 );
/**
 * Hooks footer menu in footer.
 *
 * @since 1.1.0
 */
function altitude_footer_menu() {

	genesis_nav_menu(
		[
			'theme_location' => 'footer',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
			'menu_class'     => 'genesis-nav-menu',
		]
	);

}

add_action( 'after_setup_theme', 'altitude_additional_schema', 11 );
/**
 * Adds attributes for Footer Navigation if Genesis is outputting schema.
 */
function altitude_additional_schema() {

	if ( ! genesis_is_wpseo_outputting_jsonld() && ! apply_filters( 'genesis_disable_microdata', false ) ) { // phpcs:ignore -- uses genesis filter function
		add_filter( 'genesis_attr_nav-footer', 'StudioPress\Genesis\Functions\Schema\nav_primary' );
	}

}

// Unregisters layout settings.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregisters secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

add_filter( 'genesis_author_box_gravatar_size', 'altitude_author_box_gravatar' );
/**
 * Modifies the size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @return int The new author box Gravatar size.
 */
function altitude_author_box_gravatar() {
	return 176;
}

add_filter( 'genesis_comment_list_args', 'altitude_comments_gravatar' );
/**
 * Modifies the size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Comment list arguments.
 * @return array Comment list arguments with modified avatar size.
 */
function altitude_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

// Relocates after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

/**
 * Counts widgets in given sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The id of the widget area.
 * @return void|int The number of widgets, or nothing.
 */
function altitude_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Gets class name for widget areas based on widget count.
 *
 * Used by front-page.php.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the widget area.
 * @return string The class name to use based on the widget count.
 */
function altitude_widget_area_class( $id ) {

	$count = altitude_count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 1 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 1 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 0 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

// Relocates the post info.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

add_filter( 'genesis_post_info', 'altitude_post_info_filter' );
/**
 * Modifies the entry meta in the entry header.
 *
 * @since 1.0.0
 *
 * @return string New post info.
 */
function altitude_post_info_filter() {

	return '[post_date format="M d Y"] [post_edit]';

}

add_filter( 'genesis_post_meta', 'altitude_post_meta_filter' );
/**
 * Modifies the entry meta in the entry footer.
 *
 * @return string The new entry meta.
 */
function altitude_post_meta_filter() {

	return 'Written by [post_author_posts_link] [post_categories before=" &middot; Categorized: "]  [post_tags before=" &middot; Tagged: "]';

}

add_action( 'after_setup_theme', 'altitude_widget_areas' );
/**
 * Registers Breakthrough widget areas.
 *
 * @since 1.3.1
 */
function altitude_widget_areas() {
	genesis_register_sidebar(
		[
			'id'          => 'front-page-1',
			'name'        => __( 'Front Page 1', 'altitude-pro' ),
			'description' => __( 'This is the front page 1 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-2',
			'name'        => __( 'Front Page 2', 'altitude-pro' ),
			'description' => __( 'This is the front page 2 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-3',
			'name'        => __( 'Front Page 3', 'altitude-pro' ),
			'description' => __( 'This is the front page 3 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-4',
			'name'        => __( 'Front Page 4', 'altitude-pro' ),
			'description' => __( 'This is the front page 4 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-5',
			'name'        => __( 'Front Page 5', 'altitude-pro' ),
			'description' => __( 'This is the front page 5 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-6',
			'name'        => __( 'Front Page 6', 'altitude-pro' ),
			'description' => __( 'This is the front page 6 section.', 'altitude-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-7',
			'name'        => __( 'Front Page 7', 'altitude-pro' ),
			'description' => __( 'This is the front page 7 section.', 'altitude-pro' ),
		]
	);
}

function enqueue_google_fonts() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap',
        [],
        null
    );
}

add_action('wp_enqueue_scripts', 'enqueue_google_fonts');
