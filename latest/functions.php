<?php
 
if ( ! isset( $content_width ) )
	$content_width = 640; 
 
$creativemag_options = array();
function creativemag_setup() { 
	global 	$creativemag_options;
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );
	require( get_template_directory() . '/admin/functions.php' ); 
	require( get_template_directory() . '/inc/tgm.php' ); 
  
	load_theme_textdomain( 'creativeMag', get_template_directory() . '/languages' );
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' ); 
	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'listing-thumb', 280, 160, true ); 
	global $wp_version;
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() . '/images/bg-page.gif',
	);
	if ( version_compare( $wp_version, '3.4', '>=' ) ) :
		add_theme_support( 'custom-background',$args ); 
	else :
		add_custom_background( $args );
	endif;
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
		register_nav_menus(
			array(
				'main_nav' => 'Top Main Navigation Menu',
				'drop_nav' => 'Top Drop Down Navigation Menu',
				'bottom_nav' => 'Bottom Navigation Menu'
			)
		);
	$creativemag_options = cwp();
 
	include_once(get_template_directory().'/widgets/newsletter.php');
	include_once(get_template_directory().'/widgets/social.php');
	include_once(get_template_directory().'/widgets/aboutme.php');
	include_once(get_template_directory().'/widgets/tabs-area.php');
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
} 
add_action( 'after_setup_theme', 'creativemag_setup' );

   
function creativemag_widgets_init() {
	 
	register_sidebar(array(
		'name' => 'Right Sidebar',
		'id' => 'right-sidebar',
        'before_widget' => ' <aside  class="widget sidebar-box clear">',
        'after_widget' => '</aside>', 
        'before_title' => '<header class="widget-title-sidebar-wrap"><h1 class="widget-title-sidebar">',
        'after_title' => '</h1></header><div class="widget-content">',
    ));
}
add_action( 'widgets_init', 'creativemag_widgets_init' );
add_action( 'tgmpa_register', 'creativemag_register_required_plugins' );

function creativemag_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Revive Old Post (Former Tweet Old Post) PRO', // The plugin name.
            'slug'               => 'tweet-old-post-pro', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/plugins/tweet-old-post-pro.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
  
        array(
            'name'      => 'Revive Old Post (Former Tweet Old Post)',
            'slug'      => 'tweet-old-post',
            'required'  => false,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        )
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
function creativemag_excerpt($count){
			global $post;
		  $permalink = get_permalink($post->ID);
		  $excerpt = get_the_content();
		  $excerpt = strip_tags($excerpt);
		  $excerpt = substr($excerpt, 0, $count);
		  $excerpt = strip_shortcodes($excerpt);
		  return $excerpt;
}
 
function creativemag_scripts() {
	wp_enqueue_style( 'CreativeMag-style', get_stylesheet_uri() );
 
	wp_enqueue_script( 'CreativeMag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'CreativeMag-menu', get_template_directory_uri() . '/js/menu.js', array('jquery'), '20130115', true );
	wp_enqueue_script( 'CreativeMag-main-jquery', get_template_directory_uri() . '/js/jquery-main.js', array('jquery'), '20130115', true );
	
	wp_enqueue_script( 'CreativeMag-grid-list', get_template_directory_uri() . '/js/grid-list.js', array('jquery'), '20130115', true );
	wp_enqueue_script( 'CreativeMag-customscript', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '20130115', true );
	
	wp_enqueue_script( 'CreativeMag-viewmore', get_template_directory_uri() . '/js/viewmore.js', array('jquery'), '20130115', true );
	
	wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array('jquery'), 'v1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'CreativeMag-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'creativemag_scripts' );
function creativemag_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'creativemag_add_editor_styles' );
add_filter("the_title",'creativemag_default_title');

function creativemag_default_title($title){
	if(empty($title))
		return 'No title';
	else 
		return $title;
}	

add_action('wp_head','creativemag_hook_custom');

function creativemag_hook_custom()
{
global $creativemag_options;
$output="<style type='text/css'>".$creativemag_options['CMcss']." </style>";
$output.="<script type='text/javascript'>".$creativemag_options['CMjs']." </script>";

echo $output;

}

