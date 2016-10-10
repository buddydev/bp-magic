<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "bp-magic";

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'            => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'        => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'     => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'           => 'submenu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'      => true,
	// Show the sections below the admin menu item or not
	'menu_title'          => __( 'BPMagic Options', 'bp-magic' ),
	'page_title'          => __( 'BPMagic Options', 'bp-magic' ),
	'admin_bar'           => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'      => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'  => 50,
	// Choose an priority for the admin bar menu
	'global_variable'     => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'            => false,
	'show_options_object' => false,
	// Show the time the page took to load, etc
	'update_notice'       => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'          => false,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'       => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'         => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'menu_icon'           => '',
	// Specify a custom URL to an icon
	'last_tab'            => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'           => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'           => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'       => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'        => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'        => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'  => false,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'      => 60 * MINUTE_IN_SECONDS,
	'output'              => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'          => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'            => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'             => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

);

Redux::setArgs( $opt_name, $args );

// -> START Basic Fields
Redux::setSection( $opt_name, array(
	'title'            => __( 'General Settings', 'bp-magic' ),
	'id'               => 'general',
	'desc'             => __( 'These are really general fields!', 'bp-magic' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-pencil',
	'fields'           => array(
		array(
			'id'      => 'logo_src',
			'type'    => 'media',
			'title'   => __( 'Upload Logo', 'bp-magic' ),
			'desc'    => '',
			'default' => '',
			'mode'    => 'image',
		),
		array(
			'id'      => 'favicon_src',
			'type'    => 'media',
			'title'   => __( 'Favicon Icon', 'bp-magic' ),
			'desc'    => '',
			'default' => __( 'Browse <b>favicon icon</b>. Please make sure the file is .ico or png or gif.', 'bp-magic' ),
			'mode'    => 'image',
		),
		array(
			'id'      => 'use_favicon',
			'type'    => 'select',
			'title'   => __( 'Use Favicon', 'bp-magic' ),
			'desc'    => __( 'Please select this to show/hide the favicon.', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Yes', 'bp-magic' ),
				'0' => __( 'No', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'       => 'header_scripts',
			'type'     => 'textarea',
			'title'    => __( 'Header Scripts', 'bp-magic' ),
			'sub_desc' => __( 'Add header script here, If you want to put some header script.', 'bp-magic' ),
			'desc'     => ''
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'            => __( 'Home Setting', 'bp-magic' ),
	'id'               => 'home',
	'desc'             => __( '<p class="description">Home page settings.</p>', 'bp-magic' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-home',
	'fields'           => array(
		array(
			'id'      => 'show_home_top_widget_area',
			'type'    => 'select',
			'title'   => __( 'Show Top Widget Area', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show top widget area</b>.</p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'show_home_bottom_widget_area',
			'type'    => 'select',
			'title'   => __( 'Show Bottom Widget Area', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show bottom widget area </b>.</p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'show_posts_on_home',
			'type'    => 'select',
			'title'   => __( 'Show Posts on Home Page', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'show_what_posts_on_home',
			'type'    => 'select',
			'title'   => __( 'Select type of posts to show', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic' ),
			'options' => array(
				'recent'   => __( 'Show Recent Posts', 'bp-magic' ),
				'category' => __( 'Show Posts from Specific Category', 'bp-magic' )
			),
			'default' => 'recent'
		),
		array(
			'id'    => 'home_page_posts_category',
			'type'  => 'select',
			'multi' => true,
			'title' => __( 'Select categories to show the posts', 'bp-magic' ),
			'desc'  => __( '<p class="description">select the categories from which posts will be listed on home page. It only affects if you selected the above option.</p>', 'bp-magic' ),

		),

	)
) );

Redux::setSection( $opt_name, array(
	'title'            => __( 'Design', 'bp-magic' ),
	'id'               => 'design',
	'desc'             => __( '<p class="description">Tweak your site\'s design</p>', 'bp-magic' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-magic',
	'fields'           => array(
		array(
			'id'      => 'site_background_image',
			'type'    => 'media',
			'title'   => __( 'Site Background', 'bp-magic' ),
			'desc'    => __( '<p class="description">Upload background image for the site. The uploaded image is used as background image for the website.</p>', 'bp-magic' ),
			'default' => '',
			'mode'    => 'image',
		),
		array(
			'id'      => 'site_background_repeat',
			'type'    => 'radio',
			'title'   => __( 'Repeat background Image', 'bp-magic' ),
			'desc'    => __( '<p class="description">How do you want the background image to repeat.</p>', 'bp-magic' ),
			'options' => array(
				'no-repeat' => __( 'No Repeat', 'bp-magic' ),
				'repeat'    => __( 'Repeat Both(horizontally & vertically)', 'bp-magic' ),
				'repeat-x'  => __( 'Repeat Horizontally ', 'bp-magic' ),
				'repeat-y'  => __( 'Repeat Vertically ', 'bp-magic' ),
			),
			'default' => 'repeat',
		),
		array(
			'id'      => 'site_background_color',
			'type'    => 'color',
			'title'   => __( 'Background Color', 'bp-magic' ),
			'default' => __( '#F2F2F2', 'bp-magic' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'            => __( 'Footer Setting', 'bp-magic' ),
	'id'               => 'footer',
	'desc'             => __( '<p class="description"><b> footer Setting Section</b></p>', 'bp-magic' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-stop',
	'fields'           => array(
		array(
			'id'      => 'show_footer_top_widget_area',
			'type'    => 'select',
			'title'   => __( 'Show Footer Top Widget Area', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show footer top widget area</b></p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'show_footer_3col_widget_area',
			'type'    => 'select',
			'title'   => __( 'Show Footer Widget Area(3 widget areas for 3 columns)', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show footer column widget area</b></p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'show_footer_bottom_widget_area',
			'type'    => 'select',
			'title'   => __( 'Show Footer Bottom Widget Area', 'bp-magic' ),
			'desc'    => __( '<p class="description">select option if you want <b>hide or show footer bottom widget area</b></p>', 'bp-magic' ),
			'options' => array(
				'1' => __( 'Show', 'bp-magic' ),
				'0' => __( 'Hide', 'bp-magic' )
			),
			'default' => '1'
		),
		array(
			'id'      => 'copyright_text',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'bp-magic' ),
			'desc'    => __( 'Copyright Text', 'bp-magic' ),
			'default' => __( '<p>Proudly powered by <a href="http://WordPress.org">WordPress</a>, <a href="http://buddypress.org">BuddyPress</a> & <a href="http://buddydev.com/themes/bp-magic/">BP Magic</a></p>'
				, 'bp-magic' )
		),
	)
) );

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
	function compiler_action( $options, $css, $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo "<pre>";
		print_r( $changed_values ); // Values that have changed since the last save
		echo "</pre>";
		//print_r($options); //Option values
		//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
	}
}


/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_my_custom_field' ) ) {
	function redux_my_custom_field( $field, $value ) {
		print_r( $field );
		echo '<br/>';
		print_r( $value );
	}
}


/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if ( ! function_exists( 'change_arguments' ) ) {
	function change_arguments( $args ) {
		//$args['dev_mode'] = true;
		return $args;
	}
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if ( ! function_exists( 'change_defaults' ) ) {
	function change_defaults( $defaults ) {
		$defaults['str_replace'] = 'Testing filter hook!';
		return $defaults;
	}
}