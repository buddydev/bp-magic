<?php

/**
 * Class BP_Magic_Customizer_settings
 */
class BP_Magic_Customizer_settings{

	private static $instance = null;

	private function __construct() {
		add_action( 'customize_register', array( $this, 'customizer_settings' ) );
	}

	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function customizer_settings( $wp_customize ) {

		$this->add_general_settings( $wp_customize );
		$this->add_home_settings( $wp_customize );
		$this->add_design_settings( $wp_customize );
		$this->add_footer_settings( $wp_customize );

	}

	public function add_general_settings( $wp_customize ) {

		$wp_customize->add_setting( 'header_scripts' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_section( 'bp_magic_general_settings' , array(
			'title'      => __( 'General Settings', 'bp-magic' ),
			'priority'   => 30,
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_scripts_1', array(
			'settings'      => 'header_scripts',
			'section'       => 'bp_magic_general_settings',
			'label'         => __( 'Header Script', 'bp-magic' ),
			'description'   => __('Add header script here, If you want to put some header script.', 'bp-magic'),
			'type'          => 'textarea',
		) ) );

	}

	public function add_home_settings( $wp_customize ) {

		$wp_customize->add_section( 'bp_magic_home_settings' , array(
			'title'      => __( 'Home Settings', 'bp-magic' ),
			'priority'   => 31,
		) );

		$wp_customize->add_setting( 'show_home_top_widget_area' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'show_home_bottom_widget_area' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'show_posts_on_home' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'show_what_posts_on_home' , array(
			'default'     => 'recent',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'home_page_posts_category' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_home_top_widget_area_1', array(
			'settings'      => 'show_home_top_widget_area',
			'section'       => 'bp_magic_home_settings',
			'label'         => __('Show Top Widget Area', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show top widget area</b>.</p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_home_bottom_widget_area_1', array(
			'settings'      => 'show_home_bottom_widget_area',
			'section'       => 'bp_magic_home_settings',
			'label'         => __('Show Bottom Widget Area', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show bottom widget area </b>.</p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_posts_on_home_1', array(
			'settings'      => 'show_posts_on_home',
			'section'       => 'bp_magic_home_settings',
			'label'         => __('Show Posts on Home Page', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_what_posts_on_home_1', array(
			'settings'      => 'show_what_posts_on_home',
			'section'       => 'bp_magic_home_settings',
			'label'         => __('Select type of posts to show', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic'),
			'choices'       => array(
				'recent' => __('Show Recent Posts', 'bp-magic'),
				'category' => __('Show Posts from Specific Category', 'bp-magic')
			),
			'type'          => 'select',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_page_posts_category_1', array(
			'settings'      => 'home_page_posts_category',
			'section'       => 'bp_magic_home_settings',
			'label'         => __('Select categories to show the posts', 'bp-magic'),
			'description'   => __('<p class="description">select the categories from which posts will be listed on home page. It only affects if you selected the above option.</p>', 'bp-magic'),
			'choices'       => array(),
			'type'          => 'select',
		) ) );
	}

	public function add_design_settings( $wp_customize ) {

		$wp_customize->add_section( 'bp_magic_design_settings' , array(
			'title'      => __( 'Design Settings', 'bp-magic' ),
			'priority'   => 32,
		) );

		$wp_customize->add_setting( 'site_background_image' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'site_background_repeat' , array(
			'default'     => 'repeat',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'site_background_color' , array(
			'default'     => '#F2F2F2',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_background_image_1', array(
			'label'			=> __('Site Background', 'bp-magic'),
			'description'	=> __( 'The logo is used in the site header.', 'bp-magic' ),
			'settings'      => 'site_background_image',
			'section'		=> 'bp_magic_design_settings',
			'mime_type'		=> 'image',
			'priority'		=> 1
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_background_repeat_1', array(
			'settings'      => 'site_background_repeat',
			'section'       => 'bp_magic_design_settings',
			'label'         => __('Repeat background Image', 'bp-magic'),
			'description'   => __('<p class="description">How do you want the background image to repeat.</p>', 'bp-magic'),
			'choices'       => array(
				'no-repeat' => __('No Repeat', 'bp-magic'),
				'repeat'    => __('Repeat Both(horizontally & vertically)', 'bp-magic'),
				'repeat-x'  => __('Repeat Horizontally ', 'bp-magic'),
				'repeat-y'  => __('Repeat Vertically ', 'bp-magic'),
			),
			'type'          => 'radio',
			'priority'		=> 2
		) ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_background_color_1', array(
			'settings'  => 'site_background_color',
			'section'   => 'bp_magic_design_settings',
			'label'     => __('Background Color', 'bp-magic'),
			'priority'  => 3
		) ) );

	}

	public function add_footer_settings( $wp_customize ) {

		$wp_customize->add_section( 'bp_magic_footer_settings' , array(
			'title'      => __( 'Footer Settings', 'bp-magic' ),
			'priority'   => 33,
		) );


		$wp_customize->add_setting( 'show_footer_top_widget_area' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'show_footer_3col_widget_area' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'show_footer_bottom_widget_area' , array(
			'default'     => '1',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'copyright_text' , array(
			'default'     => __('<p>Proudly powered by <a href="http://WordPress.org">WordPress</a>, <a href="http://buddypress.org">BuddyPress</a> & <a href="http://buddydev.com/themes/bp-magic/">BP Magic</a></p>'
				, 'bp-magic'),
			'transport'   => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_footer_top_widget_area_1', array(
			'settings'      => 'show_footer_top_widget_area',
			'section'       => 'bp_magic_footer_settings',
			'label'         => __('Show Footer Top Widget Area', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show footer top widget area</b></p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
			'priority'  => 1
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_footer_3col_widget_area_1', array(
			'settings'      => 'show_footer_3col_widget_area',
			'section'       => 'bp_magic_footer_settings',
			'label'         => __('Show Footer Widget Area(3 widget areas for 3 columns)', 'bp-magic'),
			'description'   => __('<p class="description">select option if you want <b>hide or show footer column widget area</b></p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
			'priority'  => 2
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_footer_bottom_widget_area_1', array(
			'settings'      => 'show_footer_bottom_widget_area',
			'section'       => 'bp_magic_footer_settings',
			'label'         => __('Show Footer Bottom Widget Area', 'bp-magic'),
			'description'   =>__('<p class="description">select option if you want <b>hide or show footer bottom widget area</b></p>', 'bp-magic'),
			'choices'       => array(
				'1' => __('Show', 'bp-magic'),
				'0' => __('Hide', 'bp-magic')
			),
			'type'          => 'select',
			'priority'  => 3
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'copyright_text_1', array(
			'settings'      => 'copyright_text',
			'section'       => 'bp_magic_footer_settings',
			'label'         => __('Copyright Text', 'bp-magic'),
			'description'   => __('copyright Text', 'bp-magic'),
			'type'          => 'textarea',
		) ) );


	}


}
BP_Magic_Customizer_settings::get_instance();