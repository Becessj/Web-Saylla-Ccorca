<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "hotmagazine_options";
    
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Hotmagazine Options', 'hotmagazine' ),
        'page_title'           => esc_html__( 'Hotmagazine Options', 'hotmagazine' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBM9vxebWLN3bq4Urobnr6tEtn7zM06rEw',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'hotmagazine' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'hotmagazine' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'hotmagazine' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( wp_kses_post( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'hotmagazine' ), $v );
    } else {
        $args['intro_text'] = wp_kses_post( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'hotmagazine' );
    }

    // Add content after the form.
    $args['footer_text'] = wp_kses_post( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'hotmagazine' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'hotmagazine' ),
            'content' => wp_kses_post( '<p>This is the tab content, HTML is allowed.</p>', 'hotmagazine' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'hotmagazine' ),
            'content' => wp_kses_post( '<p>This is the tab content, HTML is allowed.</p>', 'hotmagazine' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses_post( '<p>This is the sidebar content, HTML is allowed.</p>', 'hotmagazine' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */
    
    
    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General Settings', 'hotmagazine' ),
        'id'     => 'general',
        'desc'   => '',
        'icon'   => 'el el-icon-cogs',
        'fields' => array(
             array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Custom Favicon', 'hotmagazine'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Upload your Favicon.', 'hotmagazine'),
                'subtitle' => '',
                'default' => array('url' => ''),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Logo', 'hotmagazine'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Upload your logo.', 'hotmagazine'),
                'subtitle' => '',
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                        'id' => 'apple_icon',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Apple Touch Icon', 'hotmagazine'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => esc_html__('Upload your Apple touch icon 57x57.', 'hotmagazine'),
                        'subtitle' => '',
                        'default' => array('url' => ''),
                    ),
                    array(
                        'id' => 'apple_icon_57',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Apple Touch Icon 57x57', 'hotmagazine'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => esc_html__('Upload your Apple touch icon 57x57.', 'hotmagazine'),
                        'subtitle' => '',
                        'default' => array('url' => ''),
                    ),
                    array(
                        'id' => 'apple_icon_72',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Apple Touch Icon 72x72', 'hotmagazine'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => esc_html__('Upload your Apple touch icon 72x72.', 'hotmagazine'),
                        'subtitle' => '',
                        'default' => array('url' => ''),
                    ),
                    array(
                        'id' => 'apple_icon_114',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Apple Touch Icon 114x114', 'hotmagazine'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => esc_html__('Upload your Apple touch icon 114x114.', 'hotmagazine'),
                        'subtitle' => '',
                        'default' => array('url' => ''),
                    ),
                  
                    
            
        )
    ) );
    
    Redux::setSection( $opt_name,array(
        'icon'      => 'el el-magic',
        'title'     => esc_html__('Styling Options', 'hotmagazine'),
        'fields'    => array(
            
            array(
                'id'        => 'body_style',
                'type'      => 'select',
                'title'     => esc_html__('Theme Main Layout Style', 'hotmagazine'),
                'subtitle'  => esc_html__('Select your themes style.', 'hotmagazine'),
                'options'   => array(
                                        'default' => 'Default', 
                                        'boxed' => 'Default Boxed', 
                                        'dark' => 'Dark', 
                                        'fashion' => 'Fashion', 
                                        'sport' => 'Sport', 
                                        'tech' => 'Tech', 
                                        'design' => 'Design', 
                                        'game' => 'Game', 
                                        'travel' => 'Travel', 
                                        'politics' => 'Politics', 
                                        'video' => 'Video', 
                                        'showbiz' => 'ShowBiz', 
                                        
                                    ),
                'default'   => 'default',
            ),

            array(
                'id' => 'body-font2',
                'type' => 'typography',
                'output' => array('body'),
                'title' => esc_html__('Body Font', 'hotmagazine'),
                'subtitle' => esc_html__('Specify the body font properties.', 'hotmagazine'),
                'google' => true,
                'default' => array(
                    'color' => '#666666',
                    'font-size' => '14px',
                    'line-height' => '20px',
                    'font-family' => "Lato",
                    'font-weight' => '400',
                ),
            ),
            
            array(
                'id' => 'main-color',
                'type' => 'color',
                'title' => esc_html__('Theme main Color', 'hotmagazine'),
                'subtitle' => esc_html__('Pick theme main color (default: #f44336).', 'hotmagazine'),
                'default' => '#f44336',
                'validate' => 'color',
            ),
            
             array(
                'id'        => 'custom-css',
                'type'      => 'ace_editor',
                'title'     => esc_html__('Custom CSS Code', 'hotmagazine'),
                'subtitle'  => esc_html__('Paste your CSS code here.', 'hotmagazine'),
                'mode'      => 'css',
                'theme'     => 'monokai',
                'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                'default'   => "#header{\nmargin: 0 auto;\n}"
            ),
                 
           
        )
    ));
    
     
     Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Settings', 'hotmagazine' ),
        'id'         => 'blog_settings',
        'desc'       => '',
        'icon'   => 'el el-edit',
        'fields'     => array(
           array(
                'id'       => 'blog_thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off Featured image on Single Post', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),
           array(
                'id'       => 'blog_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off author section on Single Post', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),
            array(
                'id'       => 'related_post',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off Related Posts section on Single Post', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),

            array(
                'id'       => 'share_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off Share Button at Top of Single Post', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),

             array(
                'id'       => 'share_bottom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off Share Button at Bottom of Single Post', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),

            array(
                'id'        => 'blog_layout',
                'type'      => 'select',
                'title'     => esc_html__('Default Single Blog Layout', 'hotmagazine'),
                'subtitle'  => esc_html__('Select single blog layout.', 'hotmagazine'),
                'options'   => array(
                                        'standard' => 'Default', 
                                        'introtop' => 'Intro at top', 
                                        'fullbanner' => 'Fullwidth Banner', 
                                        'fullwidth' => 'Content Fullwidth', 
                                        'bothsidebar' => 'Both Sidebar', 
                                        
                                        
                                    ),
                'default'   => 'standard',
            ),
            array(
                'id'        => 'category_layout',
                'type'      => 'select',
                'title'     => esc_html__('Default Category Layout', 'hotmagazine'),
                'subtitle'  => esc_html__('Select Default category blog layout.', 'hotmagazine'),
                'options'   => array(
                                        'default' => 'Default', 
                                        '2colsidebar' => '2 Columns Sidebar', 
                                        '3columns' => '3 Columns', 
                                        'largeimage' => 'Large Image', 
                                        'bothsidebar' => 'Both Sidebar', 
                                        'thumbleft' => 'Thumbnail left sidebar', 
                                        'video' => 'Video', 
                                        
                                        
                                    ),
                'default'   => 'default',
            ),
        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Advertisement Settings', 'hotmagazine' ),
        'id'         => 'adv_settings',
        'desc'       => '',
        'icon'   => 'el el-edit',
        'fields'     => array(

           array(
                'id'       => 'hadv-editor',
                'type'     => 'editor',
                'title'    => esc_html__( 'Header Advertisement Content', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => '',
            ),
            
            array(
                'id'       => 'adv-editor',
                'type'     => 'editor',
                'title'    => esc_html__( 'Loop Advertisement Content', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => '',
            ),
            array(
                'id'       => 'post-banner',
                'type'     => 'editor',
                'title'    => esc_html__( 'Post Banner Advertisement Content', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => '',
            ),
        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header Settings', 'hotmagazine' ),
        'id'     => 'header',
        'desc'   => '',
        'icon'   => 'el el-th',
        'fields' => array(
             array(
                'id'       => 'header-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select your Header Layout', 'hotmagazine' ),
                'subtitle' => '',
                'desc'     => '',
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'header1' => array(
                        'alt' => 'Header style 1',
                        'img' => get_template_directory_uri(). '/images/header1.png'
                    ),
                    'header2' => array(
                        'alt' => 'Header style 2',
                        'img' => get_template_directory_uri(). '/images/header2.png'
                    ),
                    'header3' => array(
                        'alt' => 'Header style 3',
                        'img' => get_template_directory_uri(). '/images/header3.png'
                    ),
                    'header4' => array(
                        'alt' => 'Header style 4',
                        'img' => get_template_directory_uri(). '/images/header4.png'
                    ),
                    'header5' => array(
                        'alt' => 'Header style 5',
                        'img' => get_template_directory_uri(). '/images/header5.png'
                    ),'header6' => array(
                        'alt' => 'Header style 6',
                        'img' => get_template_directory_uri(). '/images/header6.png'
                    )
                ),
                'default'  => 'header1'
            ),
             array(
                'id'       => 'search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off search on header', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),
             array(
                'id' => 'city',
                'type' => 'text',
                'title' => esc_html__('Your City', 'hotmagazine'),
                'desc'     => 'Example "London"',
                'default' => '',
            ),array(
                'id' => 'country',
                'type' => 'text',
                'title' => esc_html__('Your Country', 'hotmagazine'),
                'desc'     => 'Example "United Kingdom"',
                'default' => '',
            ),array(
                'id' => 'weather',
                'type' => 'text',
                'title' => esc_html__('Weather API', 'hotmagazine'),
                'desc'     => 'You can get your API key here <a href="http://openweathermap.org/appid#get">openweathermap.api</a> or use our key "8260c1bfff32d7d4014595c5c39e531b"',
                'default' => '',
            ),array(
                'id'        => 'weather_format',
                'type'      => 'select',
                'title'     => esc_html__('Weather Format', 'hotmagazine'),
                'subtitle'  => esc_html__('Select weather format.', 'hotmagazine'),
                'options'   => array(
                                        'c' => 'Celsius', 
                                        'f' => 'Fahrenheit', 
                                        
                                        
                                    ),
                'default'   => 'c',
            ), array(
                'id'       => 'topline',
                'type'     => 'switch',
                'title'    => esc_html__( 'Turn On/Off topline on header', 'hotmagazine' ),
                'subtitle' => '',
                'default'  => true,
            ),array(
                'id' => 'topbg',
                'type' => 'color',
                'title' => esc_html__('Header Top line background', 'hotmagazine'),
                'subtitle' => esc_html__('Pick theme  color (default: #222222).', 'hotmagazine'),
                'default' => '#222222',
                'validate' => 'color',
            ),array(
                'id' => 'logo_padding',
                'type' => 'text',
                'title' => esc_html__('Logo padding:', 'hotmagazine'),
                'desc'     => 'Example "50px 15px 40px 0" ',
                'default' => '',
            ),array(
                'id' => 'logo_max',
                'type' => 'text',
                'title' => esc_html__('Logo image max height:', 'hotmagazine'),
                'desc'     => 'Example "70px" ',
                'default' => '',
            ),
            array(
                'id' => 'logo_bg',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Main Header background image', 'hotmagazine'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Upload main heaedr background.', 'hotmagazine'),
                'subtitle' => '',
                'default' => array('url' => ''),
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer Settings', 'hotmagazine' ),
        'id'     => 'footer',
        'desc'   => '',
        'icon'   => 'el el-th',
        'fields' => array(
             array(
                'id'       => 'footer-widgets',
                'type'     => 'select',
                'title'    => esc_html__( 'Turn ON footer widget area', 'hotmagazine' ),
                'subtitle' => '',
                'desc'     => '',
                //Must provide key => value pairs for select options
                'options'  => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ),
                'default'  => 'yes'
            ),array(
                'id' => 'footer-text',
                'type' => 'editor',
                'title' => esc_html__('Footer Text', 'hotmagazine'),
                'subtitle' => esc_html__('Copyright Text', 'hotmagazine'),
                'default' => '&copy; Copyright 2015. "hotmagazine" by Nunforest. All rights reserved.',
            ),
			array(
                'id' => 'footerbg',
                'type' => 'color',
                'title' => esc_html__('Footer background', 'hotmagazine'),
                'subtitle' => esc_html__('Pick background  color (default: #222222).', 'hotmagazine'),
                'default' => '#222222',
                'validate' => 'color',
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'icon' => 'el el-dribbble',
        'title' => esc_html__('Social Settinigs', 'hotmagazine'),
        'fields' => array(
            array(
                'id' => 'facebook',
                'type' => 'text',
                'title' => esc_html__('Facebook Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://www.facebook.com/',
            ),
            array(
                'id' => 'twitter',
                'type' => 'text',
                'title' => esc_html__('Twitter Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://twitter.com/',
            ),array(
                'id' => 'istagram',
                'type' => 'text',
                'title' => esc_html__('Istagram Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://istagram.com/',
            ),
            array(
                'id' => 'google',
                'type' => 'text',
                'title' => esc_html__('Google+ Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://plus.google.com',
            ),
            array(
                'id' => 'linkedin',
                'type' => 'text',
                'title' => esc_html__('Linkedin Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => 'https://www.linkedin.com/',
            ),
            
           
            array(
                'id' => 'pinterest',
                'type' => 'text',
                'title' => esc_html__('Pinterest Url', 'hotmagazine'),
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default' => '#'
            ),
        )
    )
    );
    

    /*
     * <--- END SECTIONS
     */