<?php
  /*
    Plugin Name: Web Concepten plugin
    Description: Begroet de gebruiker, Werknemersstatus
    Version: 1.0.0
    Author: Kevin Stollaerd
    License: MIT
  */

  if (!defined("ABSPATH")) {
    exit;
  }

  add_filter("the_title", "webc_greet_user");

  // fires before a nav menu item is created
  add_filter("pre_wp_nav_menu", "webc_remove_title_filter_nav_menu", 10, 2);

  // fires after a nav menu item is created
  add_filter( 'wp_nav_menu_items', "webc_add_title_filter_non_menu", 10, 2);


  function webc_greet_user($title) {
    if (is_front_page()) {
      return "Goedemiddag,<br />". $title;
    }

    return $title;
  }

  function webc_remove_title_filter_nav_menu($nav_menu, $args) {
    // this is a menu item, remove the title filter
    remove_filter("the_title", "webc_greet_user");
    return $nav_menu;
  }

  function webc_add_title_filter_non_menu( $items, $args ) {
    // we are done working with menu, so add the title filter back
    add_filter("the_title", "webc_greet_user");
    return $items;
  }


  require_once(plugin_dir_path(__FILE__)."/inc/class.employment-widget.php");
