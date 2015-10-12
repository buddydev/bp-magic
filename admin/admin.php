<?php

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if (!class_exists('NHP_Options')) {
    require_once( dirname(__FILE__) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */

/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */

function change_framework_args($args) {

    //$args['dev_mode'] = false;

    return $args;
}

//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');



/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options() {
    $args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
    $args['dev_mode'] = false;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;
//Add HTML before the form
    $args['intro_text'] = __('<p></p>', 'bp-magic');

//Setup custom links in the footer for share icons
    $args['share_icons']['home'] = array(
        'link' => 'http://BuddyDev.com',
        'title' => 'View BuddyDev',
        'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_020_home.png'
    );
    $args['share_icons']['facebook'] = array(
        'link' => 'https://www.facebook.com/bpdev',
        'title' => 'Folow us on Facebook',
        'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_320_facebook.png'
    );
    $args['share_icons']['twitter'] = array(
        'link' => 'https://twitter.com/buddydev',
        'title' => 'Folow us on Twitter',
        'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_322_twitter.png'
    );
   

//Choose to disable the import/export feature
//$args['show_import_export'] = false;
//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
    $args['opt_name'] = 'bp-magic';

//Custom menu icon
//$args['menu_icon'] = '';
//Custom menu title for options page - default is "Options"
    $args['menu_title'] = __('BP Magic Options', 'bp-magic');

//Custom Page Title for options page - default is "Options"
    $args['page_title'] = __('BP Magic Theme Options', 'bp-magic');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
    $args['page_slug'] = 'bp_magic_theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';
//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
    $args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    $args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
    $args['page_position'] = 27;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
    $args['help_tabs'][] = array(
        'id' => 'nhp-opts-1',
        'title' => __('Theme Documentation', 'bp-magic'),
        'content' => __('<p> Please read the documentation for this theme here <a href="http://buddydev.com/bp-magic/">BP Magic Docs</a>.</p>', 'bp-magic')
    );
   

//Set the Help Sidebar for the options page - no sidebar by default										
    //$args['help_sidebar'] = __('', 'bp-magic');


  $sections = array();

  $sections[] = array(
                'title' => __('General Setting', 'bp-magic'),
                'desc' => __('<p class="description"><b> general setting section </b> for bp magic.</p>', 'bp-magic'),
                'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_119_adjust.png',
                //Lets leave this as a blank section, no options just some intro text set above.
                'fields' => array(
                        array(
                            'id' => 'logo_src',
                            'type' => 'upload',
                            'title' => __('Upload Logo', 'bp-magic'),
                            'sub_desc' => '',
                            'desc' =>  ''
                       ),
                       
                        array(
                            'id' => 'favicon_src',
                            'type' => 'upload',
                            'title' => __('Favicon Icon', 'bp-magic'),
                            'desc' => __('Browse <b>favicon icon</b>. Please make sure the file is .ico or png or gif.', 'bp-magic')
                        ),
                        array(
                            'id' => 'use_favicon',
                            'type' => 'select',
                            'title' => __('Use Favicon', 'bp-magic'),
                            'desc' => __('Please select this to show/hide the favicon.', 'bp-magic'),
                            'options' => array(
                                    '1' => __('Yes', 'bp-magic'),
                                    '0' => __('No', 'bp-magic')
                                ),
                             'std' => '1'
                        ),
                       array(
                            'id'=>'header_scripts',
                            'type'=>'textarea',
                            'title'=>__('Header Scripts','bp-magic'),
                            'sub_desc' => __('Add header script here, If you want to put some header script.', 'bp-magic'),
                            'desc'=>''
                        )
                        ));
    $sections[] = array(
    
            'title' => __('Home Setting', 'bp-magic'),
            'desc' => __('<p class="description">Home page settings.</p>', 'bp-magic'),
            'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_280_settings.png',
            'fields' => array(
                
                 
         array(
            'id' => 'show_home_top_widget_area',
            'type' => 'select',
            'title' => __('Show Top Widget Area', 'bp-magic'),
            'desc' => __('<p class="description">select option if you want <b>hide or show top widget area</b>.</p>', 'bp-magic'),
            'options' => array(
                '1' => __('Show', 'bp-magic'),
                '0' => __('Hide', 'bp-magic')
            ),
            'std' => '1'
        ),
         array(
            'id' => 'show_home_bottom_widget_area',
            'type' => 'select',
            'title' => __('Show Bottom Widget Area', 'bp-magic'),
            'desc' => __('<p class="description">select option if you want <b>hide or show bottom widget area </b>.</p>', 'bp-magic'),
            'options' => array(
                '1' => __('Show', 'bp-magic'),
                '0' => __('Hide', 'bp-magic')
            ),
            'std' => '1'
    ),
         array(
            'id' => 'show_posts_on_home',
            'type' => 'select',
            'title' => __('Show Posts on Home Page', 'bp-magic'),
            'desc' => __('<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic'),
            'options' => array(
                '1' => __('Show', 'bp-magic'),
                '0' => __('Hide', 'bp-magic')
            ),
            'std' => '1'
    ),
         array(
            'id' => 'show_what_posts_on_home',
            'type' => 'select',
            'title' => __('Select type of posts to show', 'bp-magic'),
            'desc' => __('<p class="description">select option if you want <b>hide or show posts on home page </b>.</p>', 'bp-magic'),
            'options' => array(
                'recent' => __('Show Recent Posts', 'bp-magic'),
                'category' => __('Show Posts from Specific Category', 'bp-magic')
            ),
            'std' => 'recent'
    ),
            
         array(
            'id' => 'home_page_posts_category',
            'type' => 'cats_multi_select',
            'title' => __('Select categories to show the posts', 'bp-magic'),
            'desc' => __('<p class="description">select the categories from which posts will be listed on home page. It only affects if you selected the above option.</p>', 'bp-magic'),
            
           
    ),
            
                    ));
   
   /* $sections[] = array(
        'title' => __('Post Setting', 'bp-magic'),
        'desc' => __('<p class="description"><b> Post Setting Section</b> for your site.</p>', 'bp-magic'),
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
        'fields' => array(

           
            array(
                'id' => 'show_comment',
                'type' => 'select',
                'title' => __('Show Comments', 'bp-magic'),
                'desc' => __('<p class="description">select option if you want <b>hide or show Comments</b>.</p>', 'bp-magic'),
                'options' => array(
                    '1' => __('Show', 'bp-magic'),
                    '0' => __('Hide', 'bp-magic')
                ),
                'std' => '1'
            ),
            
            array(
                'id' => 'show_featured_image',
                'type' => 'select',
                'title' => __('Show Featured Image', 'bp-magic'),
                'desc' => __('<p class="description">select option if you want <b>hide or show Featured Image</b>.</p>', 'bp-magic'),
                'options' => array(
                    '1' => __('Show', 'bp-magic'),
                    '0' => __('Hide', 'bp-magic')
                ),
                'std' => '1'
            ),
            
            
           
            ));

        $sections[] = array(
            'title' => __('Color', 'bp-magic'),
            'desc' => __('<p class="description">Choose <b>text/background colors </b>for your site.</p>', 'bp-magic'),
            'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_021_snowflake.png',
            'fields' => array(

                array(
                    'id' => 'header_bgcolor',
                    'type' => 'color',
                    'title' => __('Header Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#F0F0F0','bp-magic'),
                ),
                array(
                    'id' => 'nav_bgcolor',
                    'type' => 'color',
                    'title' => __('Navigation Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#F0F0F0','bp-magic'),
                ),
                  array(
                    'id' => 'nav_dropdown',
                    'type' => 'color',
                    'title' => __('Navigation Dropdown Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#F0F0F0','bp-magic'),
                ),

               
                
                array(
                    'id' => 'footer_top',
                    'type' => 'color',
                    'title' => __('Top Footer Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#E5E5E5','bp-magic'),
                ),
                array(
                    'id' => 'footer_bottom',
                    'type' => 'color',
                    'title' => __('Bottom Footer Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#141619','bp-magic'),
                ),
                array(
                    'id' => 'footer_credits',
                    'type' => 'color',
                    'title' => __('Footer Credits Background', 'bp-magic'),
                    'sub_desc' => __('', 'bp-magic'),
                    'desc' => __('', 'bp-magic'),
                    'std'=> __('#141619','bp-magic'),
                ),

           
            ));

    $sections[] = array(
        'title' => __('Typography', 'bp-magic'),
        'desc' => __('<p class="description">This is the description field for typography Section.</p>', 'bp-magic'),
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_030_pencil.png',
        'fields' => array(
            array(
                'id' => 'font_family',
                'type' => 'font_family_select', //doesnt need to be called for callback fields
                'title' => __('Fonts Family', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('', 'bp-magic'),
            ),
            array(
                'id' => 'font_size',
                'type' => 'font_size_select',
                'title' => __('Font Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                 'desc' => __('', 'bp-magic'),
            ),
            array(
                'id' => 'font_style',
                'type' => 'font_style_select',
                'title' => __('Font Style', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                 'desc' => __('', 'bp-magic'),
            ),
            array(
                'id' => 'line_height',
                'type' => 'text',
                'title' => __('Line Height', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'heading_font_family',
                'type' => 'font_family_select', //doesnt need to be called for callback fields
                'title' => __('Heading Fonts', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                 'desc' => __('', 'bp-magic'),
            ),
            array(
                'id' => 'h1_size',
                'type' => 'text',
                'title' => __('H1 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'h2_size',
                'type' => 'text',
                'title' => __('H2 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'h3_size',
                'type' => 'text',
                'title' => __('H3 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'h4_size',
                'type' => 'text',
                'title' => __('H4 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'h5_size',
                'type' => 'text',
                'title' => __('H5 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            ),
            array(
                'id' => 'h6_size',
                'type' => 'text',
                'title' => __('H6 Size', 'bp-magic'),
                'sub_desc' => __('', 'bp-magic'),
                'desc' => __('px</br>', 'bp-magic'),
            )
            ));*/
     $sections[] = array(
        'title' => __('Design', 'bp-magic'),
        'desc' => __('<p class="description">Tweak your site\'s design</p>', 'bp-magic'),
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_019_cogwheel.png',
        'fields' => array(
            array(
                'id' => 'site_background_image',
                'type' => 'upload',
                'title' => __('Site Background', 'bp-magic'),
                'desc' => __('<p class="description">Upload background image for the site. The uploaded image is used as background image for the website.</p>', 'bp-magic')
            ),
            array(
                'id' => 'site_background_repeat',
                'type' => 'radio',
                'title' => __('Repeat background Image', 'bp-magic'),
                'desc' => __('<p class="description">How do you want the background image to repeat.</p>', 'bp-magic'),
                'options' => array(
                    'no-repeat' => __('No Repeat', 'bp-magic'),
                    'repeat' => __('Repeat Both(horizontally & vertically)', 'bp-magic'),
                    'repeat-x' => __('Repeat Horizontally ', 'bp-magic'),
                    'repeat-y' => __('Repeat Vertically ', 'bp-magic'),
                ),
                'std' => 'repeat'
            ),
            array(
                'id' => 'site_background_color',
                'type' => 'color',
                'title' => __('Background Color', 'bp-magic'),
                'sub_desc' => '',
                'desc' =>  '',
                'std'=> __('#F2F2F2','bp-magic'),
               ),    
            ));
    $sections[] = array(
        'title' => __('Footer Setting', 'bp-magic'),
        'desc' => __('<p class="description"><b> footer Setting Section</b></p>', 'bp-magic'),
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
        'fields' => array(
                
              array(
                    'id' => 'show_footer_top_widget_area',
                    'type' => 'select',
                    'title' => __('Show Footer Top Widget Area', 'bp-magic'),
                    'desc' => __('<p class="description">select option if you want <b>hide or show footer top widget area</b></p>', 'bp-magic'),
                    'options' => array(
                        '1' => __('Show', 'bp-magic'),
                        '0' => __('Hide', 'bp-magic')
                    ),
                    'std' => '1'
                    ),
          
              array(
                    'id' => 'show_footer_3col_widget_area',
                    'type' => 'select',
                    'title' => __('Show Footer Widget Area(3 widget areas for 3 columns)', 'bp-magic'),
                    'desc' => __('<p class="description">select option if you want <b>hide or show footer column widget area</b></p>', 'bp-magic'),
                    'options' => array(
                        '1' => __('Show', 'bp-magic'),
                        '0' => __('Hide', 'bp-magic')
                    ),
                    'std' => '1'
                    ),
              array(
                    'id' => 'show_footer_bottom_widget_area',
                    'type' => 'select',
                    'title' => __('Show Footer Bottom Widget Area', 'bp-magic'),
                    'desc' => __('<p class="description">select option if you want <b>hide or show footer bottom widget area</b></p>', 'bp-magic'),
                    'options' => array(
                        '1' => __('Show', 'bp-magic'),
                        '0' => __('Hide', 'bp-magic')
                    ),
                    'std' => '1'
                    ),
          
               
             array(
                    'id' => 'copyright_text',
                    'type' => 'textarea',
                    'title' => __('Copyright Text', 'bp-magic'),
                    'desc' => __('Copyright Text', 'bp-magic'),
                    'std' => __('<p>Proudly powered by <a href="http://WordPress.org">WordPress</a>, <a href="http://buddypress.org">BuddyPress</a> & <a href="http://buddydev.com/themes/bp-magic/">BP Magic</a></p>'
                                    , 'bp-magic')
                ),
            
           

            ));
		
  /*  $sections[] = array(
        'title' => __('Google Analytics Setting', 'bp-magic'),
        'desc' => __('<p class="description">This is the description for the google analytics Section. HTML is allowed</p>', 'bp-magic'),
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_362_google+_alt.png',
        'fields' => array(
            array(
                'id' => 'goole_setting',
                'type' => 'textarea',
                'title' => __('Add Analytics Code', 'bp-magic'),
                'desc' => __('<p class="description">Add Google Analytics Code here</p>', 'bp-magic')
            )
            ));

*/
    $tabs = array();

    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme();
        $theme_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    } else {
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $theme_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
    }

    $theme_info = '<div class="nhp-opts-section-desc">';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'bp-magic') . '<a href="' . $theme_uri . '" target="_blank">' . $theme_uri . '</a></p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'bp-magic') . $author . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'bp-magic') . $version . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-description">' . $description . '</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'bp-magic') . implode(', ', $tags) . '</p>';
    $theme_info .= '</div>';



    $tabs['theme_info'] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_195_circle_info.png',
        'title' => __('Theme Information', 'bp-magic'),
        'content' => $theme_info
    );

    if (file_exists(trailingslashit(get_stylesheet_directory()) . 'README.html')) {
        $tabs['theme_docs'] = array(
            'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_071_book.png',
            'title' => __('Documentation', 'bp-magic'),
            'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()) . 'README.html'))
        );
    }//if

    global $NHP_Options;
    $NHP_Options = new NHP_Options($sections, $args, $tabs);
}

//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */

function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */

function validate_callback_function($field, $value, $existing_value) {

    $error = false;
    $value = 'just testing';
    /*
      do your validation

      if(something){
      $value = $value;
      }elseif(somthing else){
      $error = true;
      $value = $existing_value;
      $field['msg'] = 'your custom error message';
      }
     */

    $return['value'] = $value;
    if ($error == true) {
        $return['error'] = $field;
    }
    return $return;
}

//function
?>