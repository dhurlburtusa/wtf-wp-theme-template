<?php
/*
This file is executed when `WP_DEBUG` is set to `true`.
*/

/*
Many actions and filters run during a request. Some are believed to only run
during a request to the admin. These are added to a non-admin request to be
scheduled to run. Some are believed to only run during a request to the
non-admin. These are added to an admin request to be scheduled to be run. If any
of these are run unexpectedly, then a log message is written.
*/
if ( is_admin() ) {

  add_action( 'wp_enqueue_scripts', function () {
    error_log( '`wp_enqueue_scripts` action unexpectedly called in admin!' );
  } );

  add_action( 'wp_head', function () {
    error_log( '`wp_head` action unexpectedly called in admin!' );
  } );

  add_action( 'wtf__document_init', function () {
    error_log( '`wtf__document_init` action unexpectedly called in admin!' );
  } );

  add_filter( 'body_class', function ( $classes ) {
    error_log( '`body_class` filter unexpectedly called in admin!' );
    return $classes;
  } );

  add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args, $depth ) {
    error_log( '`nav_menu_link_attributes` filter unexpectedly called in admin!' );
    return $atts;
  }, 10, 4);

  add_filter( 'widget_tag_cloud_args', function ( $args ) {
    error_log( '`widget_tag_cloud_args` filter unexpectedly called in admin!' );
    return $args;
  } );

  add_filter( 'wp_nav_menu_objects', function ( $sorted_menu_items, $args ) {
    error_log( '`wp_nav_menu_objects` filter unexpectedly called in admin!' );
    return $sorted_menu_items;
  }, 10, 2 );

  add_filter( 'wtf__document_body_content_tpl_name', function ( $tpl_name ) {
    error_log( '`wtf__document_body_content_tpl_name` filter unexpectedly called in admin!' );
    return $tpl_name;
  } );

}
else {

  add_action( 'edit_category', function () {
    error_log( '`edit_category` action unexpectedly called in non-admin!' );
  } );

  add_action( 'enqueue_block_editor_assets', function () {
    error_log( '`enqueue_block_editor_assets` action unexpectedly called in non-admin!' );
  } );

}
