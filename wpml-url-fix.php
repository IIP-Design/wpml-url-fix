<?php
/**
 * Plugin Name: WPML URL Fix
 * Description: A WordPress plugin to resolve a URL issue with the WPML language switcher when the WPML plugin is active.
 * Author: Scott Gustas
 * Version: 1.0.0
 */

//If WPML is activated, let's hide the login form
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$requiredplugin = 'sitepress-multilingual-cms/sitepress.php';

if ( is_plugin_active($requiredplugin) ) {

  function wpml_url_fix( $languages ) {

    global $wpml_url_converter;

    $abs_home = $wpml_url_converter->get_abs_home();
    foreach( $languages as $lang => $element ){

      $correct_url = get_site_url();
      
      if ( strstr( $languages[$lang]['url'], $abs_home ) ) {
        $languages[$lang]['url'] = str_replace( $abs_home, $correct_url, $languages[$lang]['url'] );
      }
    }
    return $languages;
  }

  add_filter( 'icl_ls_languages', 'wpml_url_fix');

}
