<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

//Disable WordPress admin bar on Front end, we don't want it for our theme 
add_filter( 'show_admin_bar', '__return_false' );

/* Disable BuddyPress Admin bar too */
if ( ! defined( 'BP_DISABLE_ADMIN_BAR' ) )
	define( 'BP_DISABLE_ADMIN_BAR', true );


/* If BuddyPress is not activated, switch back to the default WP theme and bail out
  We don't support WordPress without BuddyPress at the moment
 */

if ( ! function_exists( 'bp_is_active' ) ) {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	return;
}

/**
 * BPMagic Theme Helper
 * Helps to setup the widgets, register features support etc
 * It is implemented as singleton class, Use BPMagic::get_instance() to access the singleton object and de-register actions/filters in the child theme 
 */
class BPMagic_Theme_Helper {

	private static $instance;

	private function __construct() {

		add_action( 'after_setup_theme', array( $this, 'setup' ) ); //initialize the setup, load files
		
		add_action( 'init', array( $this, 'setup_filters' ) ); //setup basic filters
		add_action( 'widgets_init', array( $this, 'register_widgetarea' ) ); //register widgetized areas
		
		add_filter( 'bp_get_the_body_class', array( $this, 'add_body_class' ) ); //add no-js class to body element
		add_action( 'bp_before_header', array( $this, 'remove_nojs_body_class' ) ); //remove no-js class from body element
		
		add_filter( 'wp_page_menu_args', array( $this, 'page_menu_args' ) ); //show home in the main menu
		add_action( 'wp_head', array( $this, 'load_theme_settings' ) ); //initialize load theme settings
		// add_action('admin_head', array($this, 'faviconicon' ));//add favicon in admin
	}

	/**
	 * Creates/Returns the singleton instance
	 * 
	 * @return BPMagic_Theme_Helper
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * All the things are setup here
	 * We load theme text domain
	 * Load admin panel if inside the wp-admin
	 * Load various libraries here
	 * 
	 */
	public function setup() {
		
		//load text domain
		$this->load_textdomain();
		
		$theme_dir = get_template_directory();
		
		//if we are inside the admin panel, let us load theme options panel code
		if ( is_admin() ) {
			include_once( $theme_dir . '/admin/admin.php');
		}

		//load template specific code

		require( $theme_dir . '/lib/core.php' );
		require( $theme_dir . '/lib/template.php' );
		//load post extension
		require( $theme_dir . '/lib/post-ext.php' );
		//comment lib
		require( $theme_dir . '/lib/comment-ext.php' );
		require( $theme_dir . '/lib/hooks.php' );

		//load bbpress specific files if bbpress is active
		if ( function_exists( 'bbpress' ) )
			require( $theme_dir . '/lib/bbpress.php' );
		//css/js loader
		require( $theme_dir . '/lib/css-js.php' );

		// Load the AJAX functions for the theme

		require( $theme_dir . '/_inc/ajax.php' );

		$this->register_features(); //register various features
		//register theme menu
		$this->register_menus();


		if ( ! is_admin() || (is_admin() && defined( 'DOING_AJAX' )) ) {
			$this->register_buttons(); //register various buttons
		}
	}

	/**
	 * Load theme translation  file
	 */
	function load_textdomain() {
		//load child theme text domain if any
		load_child_theme_textdomain( 'bp-magic', get_stylesheet_directory() . '/languages' );
		//load the parent theme file if exist
		//if there is a conflict on the translation, the child theme will preceed
		load_theme_textdomain( 'bp-magic', get_template_directory_uri() . '/languages' );
	}

	/**
	 * Register Top Main Menu
	 */
	public function register_menus() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Top Main Menu', 'bp-magic' ),
		) );
	}

	/**
	 * Register theme features
	 */
	public function register_features() {

		// suports buddypress
		add_theme_support( 'buddypress' );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		//featured images
		add_image_size( 'featured-image', 268, 102, true ); //used on archive page/home page
		add_image_size( 'slider-full-image', 806, 325, true ); //for slider
		add_image_size( 'single-featured-image', 560, 300, true ); //for single post
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		//$this->support_custom_background();
		// $this->support_custom_header();
	}

	/**
	 * Register/enable BuddyPress general buttons like add/cancel friend, join group etc on directory and single component pages
	 */
	public function register_buttons() {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) ) {
			add_action( 'bp_member_header_actions', 'bp_add_friend_button', 5 );
		}
		
		// Activity mention button
		if ( bp_is_active( 'activity' ) ) {
			add_action( 'bp_member_header_actions', 'bp_send_public_message_button', 20 );
		}
		
		// Messages button
		if ( bp_is_active( 'messages' ) ) {
			add_action( 'bp_member_header_actions', 'bp_send_private_message_button', 20 );
		}
		
		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions', 'bp_group_join_button', 5 );
			add_action( 'bp_group_header_actions', 'bp_group_new_topic_button', 20 );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) ) {
			add_action( 'bp_directory_blogs_actions', 'bp_blogs_visit_blog_button' );
		}
		
	}

	/**
	 * Register widget areas
	 */
	public function register_widgetarea() {
		//home page top&bottom widget areas can be enabled/disabled via Theme options panel
		// Area 1, located in the home page top. Empty by default 
		register_sidebar( array(
			'name'			=> __( 'Home Page Top Widget Area', 'bp-magic' ),
			'id'			=> 'home-top-widget-area',
			'description'	=> __( 'The homepage top widet area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );
		// Area 2, located in the home page bottom. Empty by default 
		register_sidebar( array(
			'name'			=> __( 'Home Page Bottom Widget Area', 'bp-magic' ),
			'id'			=> 'home-bottom-widget-area',
			'description'	=> __( 'The homepage bottom widet area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );


		// Area 3, located in the sidebar Right. Empty by default.
		register_sidebar( array(
			'name'			=> 'Sidebar Right',
			'id'			=> 'sidebar',
			'description'	=> __( 'The sidebar widget area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );
		// Area 4, located in the sidebar Left. Empty by default.
		register_sidebar( array(
			'name'			=> 'Sidebar Left',
			'id'			=> 'sidebar-left',
			'description'	=> __( 'The bottom area of userbar in the left sidebar', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );
		// Area 5, located in the footer top. Empty by default 
		register_sidebar( array(
			'name'			=> __( 'Footer Top Full column Widget Area', 'bp-magic' ),
			'id'			=> 'footer-widget-full-col-top',
			'description'	=> __( 'The footer top widet area, expands to the complete footer area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );
		// Area 6, located in the footer. Empty by default.
		//footer widget area top: col1
		register_sidebar( array(
			'name'			=> __( 'Footer Top Widget Area(Column 1)', 'bp-magic' ),
			'id'			=> 'first-footer-widget-area',
			'description'	=> __( 'The top footer widget area column 1', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );

		// Area 7, located in the footer. Empty by default.
		//footer widget area top: col2
		register_sidebar( array(
			'name'			=> __( 'Footer Top Widget Area(Column 2)', 'bp-magic' ),
			'id'			=> 'second-footer-widget-area',
			'description'	=> __( 'The second footer widget area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );

		// Area 8, located in the footer. Empty by default.
		//footer widget area top: col3
		register_sidebar( array(
			'name'			=> __( 'Footer Top Widget Area(Column 3)', 'bp-magic' ),
			'id'			=> 'third-footer-widget-area',
			'description'	=> __( 'The third footer widget area', 'bp-magic' ),
			'before_widget'	=> '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );


		// Area 9, located in the footer. Empty by default 
		register_sidebar( array(
			'name'			=> __( 'Footer Bottom Full column Widget Area', 'bp-magic' ),
			'id'			=> 'footer-widget-full-col-bottom',
			'description'	=> __( 'The footer bottom widet area, expands to the complete footer area', 'bp-magic' ),
			'before_widget' => '<div id="%1$s" class="clearfix widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="widgettitle">',
			'after_title'	=> '</h3>'
		) );
	}

	public function setup_filters() {
		// add_filter( 'excerpt_length', 'bpmagic_custom_excerpt_length' );//limit excerpt length
		// add_filter( 'excerpt_more', 'bpmagic_auto_excerpt_more' );//what should be the more
		//add_filter( 'get_the_excerpt', 'bpmagic_custom_excerpt_more' ); //customize the excerpt
		add_filter( 'the_content_rss', 'do_shortcode' ); //allow shortcodes in feed
		//we will need this
		//post_thumbnail_html'post_thumbnail_html', $html, $post_id, $post_thumbnail_id, $size, $attr 
		// Adds filters for the description/meta content in archives.php
		//add_filter( 'archive_meta', 'wptexturize' );
		//add_filter( 'archive_meta', 'convert_smilies' );
		//add_filter( 'archive_meta', 'convert_chars' );
		// add_filter( 'archive_meta', 'wpautop' );
	}

	/**
	 * Adds the no-js and other theme specific classes to the body element
	 *
	 * This function ensures that the <body> element will have the 'no-js' class by default. If you're
	 * using JavaScript for some visual functionality in your theme, and you want to provide noscript
	 * support, apply those styles to body.no-js.
	 *
	 * The no-js class is removed by the JavaScript created in bp_dtheme_remove_nojs_body_class().
	 *
	 * @see remove_nojs_body_class()
	 */
	public function add_body_class( $classes ) {
		
		$classes[] = 'no-js';
		
		if ( ! is_user_logged_in() ) {
			$classes[] = 'not-logged';
		}
		
		if ( is_active_sidebar( 'sidebar-left' ) ) {
			$classes[] = 'sidebar-left-active';
		}
		
		if ( is_home() && bpmagic_has_slideshow() ) {
			$classes[] = 'home-with-slideshow';
		}
		
		if ( bp_is_group() ) {
			$classes[] = 'single-group';
		}
		
		return array_unique( $classes );
	}

	/**
	 * Dynamically removes the no-js class from the <body> element.
	 *
	 * By default, the no-js class is added to the body (see bp_dtheme_add_no_js_body_class()). The
	 * JavaScript in this function is loaded into the <body> element immediately after the <body> tag
	 * (note that it's hooked to bp_before_header), and uses JavaScript to switch the 'no-js' body class
	 * to 'js'. If your theme has styles that should only apply for JavaScript-enabled users, apply them
	 * to body.js.
	 *
	 * This technique is borrowed from WordPress, wp-admin/admin-header.php.
	 *
	 * 
	 * @see self::add_body_class()
	 */
	public function remove_nojs_body_class() {
		?>
		<script type="text/javascript">//<![CDATA[
			( function () {
				var c = document.body.className;
				c = c.replace( /no-js/, 'js' );
				document.body.className = c;
			} )();
			//]]></script>
		<?php

	}

	/**
	 * 
	 *
	 * @param array $args Default values for wp_page_menu()
	 * @see wp_page_menu()
	 * 
	 */
	public function page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}

	/**
	 * Load theme setting option function 
	 */
	public function load_theme_settings() {

		require_once get_template_directory() . '/theme-setting.css.php';
	}

	/**
	 * Add favicon icon for site
	 */
	public function faviconicon() {

		$favicon_icon = bpmagic_get_option( "favicon_icon" );

		echo "<link rel='Shortcut Icon' type='image/x-icon' href='$favicon_icon'/>";
	}

}

//Instantiate the helper
BPMagic_Theme_Helper::get_instance(); //instantiate the helper which will setup the theme in turn

/**
 * Get theme specific option
 * All theme specific options are stored in options table with the option name 'bp-magic'(associative arry of info)
 * @param string $option_name the name of the option
 * @return mixed
 */
function bpmagic_get_option( $option_name ) {

	$default = array(
		'logo_src'							=> '',
		'favicon_src'						=> '',
		'show_home_top_widget_area'			=> 0,
		'show_home_bottom_widget_area'		=> 0,
		'show_posts_on_home'				=> 1,
		'show_what_posts_on_home'			=> 'recent',
		'show_footer_top_widget_area'		=> 1,
		'show_footer_bottom_widget_area'	=> 1,
		'show_footer_3col_widget_area'		=> 1
	);
	
	$settings = get_option( 'bp-magic', array() ); //should we fallback to bp_get_otpion ? or get_site_option

	if ( isset( $settings[ $option_name ] ) ) {
		return $settings[ $option_name ];
	}

	return false;
}
