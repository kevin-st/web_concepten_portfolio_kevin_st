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

  add_action("wp_loaded", "webc_set_cookie");

  add_filter("the_title", "webc_greet_user", 10, 2);
  // fires before a nav menu item is created
  add_filter("pre_wp_nav_menu", "webc_remove_title_filter_nav_menu", 10, 2);
  // fires after a nav menu item is created
  add_filter('wp_nav_menu_items', "webc_add_title_filter_non_menu", 10, 2);

  function webc_set_cookie() {
    if (!isset($_COOKIE["user-visit-cookie"])) {
      setcookie('user-visit-cookie', '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
    }
  }

  function webc_greet_user($title, $id) {
    $current_hour = intval(date_i18n("H"));
    $greeting = "";

    if (!isset($_COOKIE["user-visit-cookie"])) {
      if ($current_hour > 0 && $current_hour < 6) {
        $greeting = "Goedenacht";
      } else if ($current_hour > 6 && $current_hour < 12) {
        $greeting = "Goedemorgen";
      } else if ($current_hour > 12 && $current_hour < 18) {
        $greeting = "Goedemiddag";
      } else {
        $greeting = "Goedenavond";
      }
    } else {
      $greeting = "Welkom terug";
    }

    if (is_front_page() && $id === 7) {
      return $greeting .",<br />". $title;
    }

    return $title;
  }

  function webc_remove_title_filter_nav_menu($nav_menu, $args) {
    // this is a menu item, remove the title filter
    remove_filter("the_title", "webc_greet_user", 10, 2);
    return $nav_menu;
  }

  function webc_add_title_filter_non_menu($items, $args) {
    // we are done working with menu, so add the title filter back
    add_filter("the_title", "webc_greet_user", 10, 2);
    return $items;
  }


  require_once(plugin_dir_path(__FILE__)."/inc/class.employment-widget.php");
