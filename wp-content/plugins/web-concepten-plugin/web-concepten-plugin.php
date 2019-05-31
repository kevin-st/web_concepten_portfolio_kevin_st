<?php
  /*
    Plugin Name: Web Concepten plugin
    Description: Begroet de gebruiker, Werknemersstatus
    Version: 1.0.0
    Author: Kevin Stollaerd
    License: MIT
  */

  // prevent browsing to this plugin
  if (!defined("ABSPATH")) {
    exit;
  }

  // set hooks
  add_action("init", "webc_set_cookie");
  add_action('init', 'webc_log_user');

  add_filter("the_title", "webc_greet_user", 10, 2);
  add_filter("pre_wp_nav_menu", "webc_remove_title_filter_nav_menu", 10, 2);  // fires before a nav menu item is created
  add_filter('wp_nav_menu_items', "webc_add_title_filter_non_menu", 10, 2); // fires after a nav menu item is created

  // include widgets
  require_once(plugin_dir_path(__FILE__)."/inc/class.employment-widget.php");
  require_once(plugin_dir_path(__FILE__)."/inc/class.counter-widget.php");

  // function to execute on plugin activation
  register_activation_hook(__FILE__, "webc_install");
  // function to execute on plugin deactivation
  register_deactivation_hook(__FILE__, "webc_uninstall");

  /**
   * Set cookies
   */
  function webc_set_cookie() {
    // cookie needed to check if the user has already visited the site
    if (!isset($_COOKIE["user-visit-cookie"])) {
      setcookie('user-visit-cookie', '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
    }
  }

  /**
   * Greet the user
   */
  function webc_greet_user($title, $id) {
    $current_hour = intval(date_i18n("H"));
    $greeting = "";

    // if the user hasn't visited the site yet
    if (!isset($_COOKIE["user-visit-cookie"])) {
      if ($current_hour >= 0 && $current_hour < 6) {
        $greeting = "Goedenacht";
      } else if ($current_hour >= 6 && $current_hour < 12) {
        $greeting = "Goedemorgen";
      } else if ($current_hour >= 12 && $current_hour < 18) {
        $greeting = "Goedemiddag";
      } else {
        $greeting = "Goedenavond";
      }
    } else { // the user has visited the site already, just say welcome back
      $greeting = "Welkom terug";
    }

    // when on the front page
    if (is_front_page() && $id === 7) {
      return $greeting .",<br />". $title;
    }

    return $title;
  }

  /**
   * Remove the_title filter, so the title of a menu item isn't altered
   */
  function webc_remove_title_filter_nav_menu($nav_menu, $args) {
    // this is a menu item, remove the title filter
    remove_filter("the_title", "webc_greet_user", 10, 2);
    return $nav_menu;
  }

  /**
   * Add the title filter again, so the title can be altered again
   */
  function webc_add_title_filter_non_menu($items, $args) {
    // we are done working with menu, so add the title filter back
    add_filter("the_title", "webc_greet_user", 10, 2);
    return $items;
  }

  /**
   * Initialization of the plugin
   */
  function webc_install() {
    global $wpdb;

    // create a table called wp_webc_log
    $webc_log_table = $wpdb->prefix . 'webc_log';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $sql = "
    CREATE TABLE IF NOT EXISTS $webc_log_table
    (
        `LogID` int(11) NOT NULL AUTO_INCREMENT,
        `IP` varchar(20) NOT NULL,
        `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (`LogID`)
    );";

    // execute the query
    dbDelta($sql);
  }

  /**
   * Execute when the plugin is deactivated
   */
  function webc_uninstall() {
    global $wpdb;
    $webc_log_table = $wpdb->prefix."webc_log";

    // drop the table if it exists
    $wpdb->query("DROP TABLE IF EXISTS $webc_log_table");
  }

  /**
   * Get the amount of visits of a given IP address
   */
  function webc_get_visit_count() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'webc_log';
    // get the IP of the user
    $ip = $_SERVER["REMOTE_ADDR"];

    $condition = "IP='".$ip."' AND DATE(`Time`)=DATE(NOW())";

    // find all records for the current IP
    $sql = "SELECT COUNT(*) FROM $table_name WHERE ".$condition;
    $count = $wpdb->get_var($sql);

    return $count;
  }

  /**
   * Create a log when a user has visited the site.
   */
  function webc_log_user() {
    if (!is_admin()) {
      global $wpdb;
      $table_name = $wpdb->prefix . 'webc_log';

      // insert a log in the database
      $sql = "INSERT INTO $table_name (IP) VALUES ('$_SERVER[REMOTE_ADDR]')";
      $results = $wpdb->get_results($sql);
    }
  }
