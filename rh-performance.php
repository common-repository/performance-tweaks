<?php
/*
 Plugin Name: Performance Tweaks
 Description: WordPress Performance Tweaks. Simple but effective.
 Version: 0.6.5
 Contributors: rhoekman
 Author:      Rick Hoekman
 License:     GNU General Public License v3 or later
 License URI: http://www.gnu.org/licenses/gpl-3.0.html
 Author URI: https://www.rickhoekman.com
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Admin Settings namespacing and page

class PerformanceTweaksPlugin {

  function __construct() {
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
  }

  
  function settings() {
    add_settings_section('rhptp_first_section', null, null, 'perf-tweaks-settings-page');


    // ContactForm7 smart loader
    add_settings_field('rhptp_contactform7_checkbox', 'ContactForm7 Smart Loader', array($this, 'contactform7HTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_contactform7_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Disable Advanced Custom Fields on frontend

    add_settings_field('rhptp_acf_checkbox', 'Disable Advanced Custom Fields on Frontend', array($this, 'acfHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_acf_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Emoji unloader
    add_settings_field('rhptp_emoji_checkbox', 'Emoji Unloader', array($this, 'emojiHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_emoji_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Defer JavaScript
    add_settings_field('rhptp_deferjs_checkbox', 'Defer JavaScript', array($this, 'deferjsHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_deferjs_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
    
    // Async JavaScript
    add_settings_field('rhptp_asyncjs_checkbox', 'Async JavaScript', array($this, 'asyncjsHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_asyncjs_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
  
    // Remove Query Strings
    add_settings_field('rhptp_removeqs_checkbox', 'Remove Query Strings', array($this, 'removeqsHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_removeqs_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
  
    // DNS Single Post Prefetch

    add_settings_field('rhptp_dns_checkbox', 'DNS Single Post Prefetch', array($this, 'dnsHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_dns_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Disable XML-RPC
    add_settings_field('rhptp_xmlrpc_checkbox', 'Disable XML-RPC', array($this, 'xmlrpcHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_xmlrpc_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Disable WordPress Heartbeat
    add_settings_field('rhptp_heartbeat_checkbox', 'Disable WordPress Heartbeat', array($this, 'heartbeatHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_heartbeat_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // Limit WordPress post revisions
    add_settings_field('rhptp_revisions_checkbox', 'Limit WordPress Post Revisions', array($this, 'revisionsHTML'), 'perf-tweaks-settings-page', 'rhptp_first_section');
    register_setting('perftweaksplugin', 'rhptp_revisions_checkbox', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

  }

function contactform7HTML() { ?>
<input type="checkbox" name="rhptp_contactform7_checkbox" value="1" <?php checked(get_option('rhptp_contactform7_checkbox'), '1') ?>> Removes CSS and JavaScript from ContactForm7 on pages without a form. 

<?php }

function acfHTML() { ?>
<input type="checkbox" name="rhptp_acf_checkbox" value="1" <?php checked(get_option('rhptp_acf_checkbox'), '1') ?>> ACF or Advanced Custom Fields is a WordPress plugin to create custom Meta Boxes on your site. Most sites uses ACF to show meta boxes in the Admin area of the site and rarely use it on the front-end.

Despite that, ACF loads, JS/CSS files on the front-end as well which can add more resources on the front-end of your site.

<?php }

function emojiHTML() { ?>
  <input type="checkbox" name="rhptp_emoji_checkbox" value="1" <?php checked(get_option('rhptp_emoji_checkbox'), '1') ?>> Removes Emoji CSS and JavaScript from pages.

  <?php }

function deferjsHTML() { ?>
  <input type="checkbox" name="rhptp_deferjs_checkbox" value="1" <?php checked(get_option('rhptp_deferjs_checkbox'), '1') ?>> Add the defer attribute to JavaScript files. The defer attribute tells the browser not to wait for the script. Instead, the browser will continue to process the HTML and build the DOM. The script loads “in the background”, and then runs when the DOM has been fully built.

  <?php }

function asyncjsHTML() { ?>
  <input type="checkbox" name="rhptp_asyncjs_checkbox" value="1" <?php checked(get_option('rhptp_asyncjs_checkbox'), '1') ?>> Add the async attribute to JavaScript files. Async scripts load in the background and they run immediately after they are loaded.

  <?php } 

function removeqsHTML() { ?>
  <input type="checkbox" name="rhptp_removeqs_checkbox" value="1" <?php checked(get_option('rhptp_removeqs_checkbox'), '1') ?>> Remove query strings from static resources. WordPress by default adds a query string to all CSS and JS files used in your site. Having this query string might make some CDNs to not cache these files.

  <?php }

  function dnsHTML() { ?>
  <input type="checkbox" name="rhptp_dns_checkbox" value="1" <?php checked(get_option('rhptp_dns_checkbox'), '1') ?>> Enable DNS Prefetching on single posts, so when a user is on single post or page or any custom post type and clicks on the link for homepage then the homepage will open without any delay.

  Note: DNS Prefetching only works with HTTP2. So, if your server does not support HTTP2 then this will not work.

  <?php }

  function xmlrpcHTML() { ?>
  <input type="checkbox" name="rhptp_xmlrpc_checkbox" value="1" <?php checked(get_option('rhptp_xmlrpc_checkbox'), '1') ?>> The WordPress XML-RPC is a specification that aims to standardize communications between different systems. It uses the HTTP protocol and XML as an encoding mechanism which allows for various data to be transmitted.
  Are you using any desktop based application to write post for your blog? If not, then its best to disable XML-RPC on your site as this can be used to do a DDOS attack on your site.

  <?php }

  function heartbeatHTML() { ?>
  <input type="checkbox" name="rhptp_heartbeat_checkbox" value="1" <?php checked(get_option('rhptp_heartbeat_checkbox'), '1') ?>> WP Heartbeat API works by calling the admin-ajax.php file and on server with low memory or shared hosting this can significantly slow down the website.

  <?php }

  function revisionsHTML() { ?>
  <input type="checkbox" name="rhptp_revisions_checkbox" value="1" <?php checked(get_option('rhptp_revisions_checkbox'), '1') ?>> Limit the number of Post Revisions to 5. This will help to reduce the size of the database.

  <?php }

  function adminPage() {
    add_options_page('Performance Tweaks Settings', 'Performance Tweaks', 'manage_options', 'perf-tweaks-settings-page', array($this, 'ourHTML'));
  }  
  
  function ourHTML() { ?>
    <div class="wrap">
      <h1>Performance Tweaks Settings</h1>
      <form action="options.php" method="POST">
        <?php
          settings_fields('perftweaksplugin');
          do_settings_sections('perf-tweaks-settings-page');
          submit_button();
        ?>
      </form>
    </div>
  
  <?php }
  
}

// Add a link for the settings page
function rhptp_add_settings_link( $links ) {
  $settings_link = '<a href="admin.php?page=perf-tweaks-settings-page">' . __( 'Settings', 'perf-tweaks-settings-page' ) . '</a>';
  array_push( $links, $settings_link );
  return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename( __FILE__ );
add_filter( $filter_name, 'rhptp_add_settings_link' );


$performanceTweaksPlugin = new PerformanceTweaksPlugin();

// Removes CSS and JS when there's no contactform in use

if (get_option('rhptp_contactform7_checkbox')) {

  add_action( 'wp_enqueue_scripts', 'rhptp_wpcf7_scripts_removal_contact_form_7', 999);

function rhptp_wpcf7_scripts_removal_contact_form_7() {
  
  global $post;
  
  if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7') ) {
	
	wp_enqueue_script('contact-form-7');
	wp_enqueue_style('contact-form-7');
	 
  } else {
	
	wp_dequeue_script( 'contact-form-7' );
	wp_dequeue_style( 'contact-form-7' );
	
    }
  }
}

// Disables Advanced Custom Fields on frontend

if (get_option('rhptp_acf_checkbox')) {

  add_action( 'wp_enqueue_style', 'rhptp_deregister_styles', 100 );
  
function rhptp_deregister_styles() {
 if( ! is_admin() ) {
  wp_deregister_style( 'acf' );
  wp_deregister_style( 'acf-field-group' );
  wp_deregister_style( 'acf-global' );
  wp_deregister_style( 'acf-input' );
  wp_deregister_style( 'acf-datepicker' );
 }
}
}

if (get_option('rhptp_emoji_checkbox')) {
/**
 * Disable the emoji's
 */
function rhptp_disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'rhptp_disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'rhptp_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'rhptp_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function rhptp_disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
    }
  }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference between the two arrays.
 */
function rhptp_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

// Defer JavaScript
if (get_option('rhptp_deferjs_checkbox') && !is_admin()) {
function rhptp_defer_parsing_of_js ( $url ) {
  if ( FALSE === strpos( $url, '.js' ) ) return $url;
  if ( strpos( $url, 'jquery.js' ) ) return $url;
  return "$url' defer ";
  
}
  add_filter( 'clean_url', 'rhptp_defer_parsing_of_js', 11, 1 );
}

// Async JavaScript
if (get_option('rhptp_async_checkbox')) {
function rhptp_async_parsing_of_js ( $url ) {
  if ( FALSE === strpos( $url, '.js' ) ) return $url;
  if ( strpos( $url, 'jquery.js' ) ) return $url;
  return "$url' async ";
  
}
  add_filter( 'clean_url', 'rhptp_async_parsing_of_js', 11, 1 );
}

// Remove query strings from static resources
if (get_option('rhptp_removeqs_checkbox')) {
  function rhptp_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
     $src = remove_query_arg( 'ver', $src );
    return $src;
    }
    add_filter( 'style_loader_src', 'rhptp_remove_cssjs_ver', 10, 2 );
    add_filter( 'script_loader_src', 'rhptp_remove_cssjs_ver', 10, 2 );

  }

// DNS Prefetch Single Post
  if (get_option('rhptp_dns_prefetch_checkbox')) {
    function rhptp_dns_prefetch(){
          
      if ( is_singular() ) { 
          echo '<link rel="prefetch" href="' .esc_url( home_url() ) . '">';               
          echo '<link rel="prerender" href="' .esc_url( home_url() ) . '">';             
      }
      add_action('wp_head', 'rhptp_dns_prefetch');
    }
  }

  // Disable XML-RPC
  if (get_option('rhptp_xmlrpc_checkbox')) {
    add_filter('xmlrpc_enabled', '__return_false');
  }

  // Disable WordPress Heartbeat
  if (get_option('rhptp_heartbeat_checkbox')) {
    add_action( 'init', 'rhptp_stop_heartbeat', 1 );
    function rhptp_stop_heartbeat() {
    wp_deregister_script('heartbeat');
  }

  // Limit post revisions to 5
  if (get_option('rhptp_revisions_checkbox')) {
    if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);
  }
}

