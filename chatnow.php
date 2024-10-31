<?php
/**
 * Plugin Name: ChatNow chat
 * Description: Chat with your website visitors and increase sales.
 * Author: mychatnow
 * Version: 1.0.0
 */

// Add multilingual support
load_plugin_textdomain( 'chatra', false, basename( dirname( __FILE__ ) ) . '/languages' );

// Add settings page and register settings with WordPress
add_action('admin_menu', 'chatra_setup');

function chatra_setup() {
  // add_menu_page( 'ChatNow Plugin Page', 'Chatra', 'manage_options', 'options-chatra', 'chatra_settings' );
  add_submenu_page('options-general.php', __( 'ChatNow Live Chat Plugin', 'chatra'), __( 'ChatNow Live Chat', 'chatra'), 'manage_options', 'options-chatra', 'chatra_settings' );

  register_setting( 'chatra', 'chatra-code' );
}

// Display settings page
function chatra_settings() {
  echo "<h2>" . __( 'ChatNow Live Chat Setup', 'chatra' ) . "</h2>";
  if (get_option('chatra-code')) {
    echo "<p>" . __( 'Seems like everything is OK!<br>
Check your <a href="', 'chatra') . home_url() . __('">website</a> to see if the live chat widget is present.<br>
Log in to your <a href="http://app.mychatnow.com/?utm_source=WP_chatnow&utm_campaign=WP_chatnow" target="_blank">ChatNow dashboard</a> to chat with your website visitors and manage preferences.<br>', 'chatra');
  } else {
    echo "<p>" . __( 'Signup for a free ChatNow account at <a href="http://app.mychatnow.com/?utm_source=WP_chatnow&utm_campaign=WP_chatnow" target="_blank">app.mychatnow.com</a>,<br> then copy and paste Widget code from Setup & Customize section into the form below:
', 'chatra' ) . "</p>";
  }

  echo "<form action=\"options.php\" method=\"POST\">";

    // Show success message when code is saved
    // if (isset($_GET['settings-updated'])) {
    //   echo "<p><strong style=\"color: green;\">Settings updated successfully.</strong><br><br>";
    // }

    settings_fields( 'chatra' );
    do_settings_sections( 'chatra' );
    echo "<textarea cols=\"80\" rows=\"14\" name=\"chatra-code\">" . esc_attr( get_option('chatra-code') ) . "</textarea>";
    submit_button();
  echo "</form>";
}


// add_action('update_option_chatra', 'chatra_options_saved');
// function chatra_options_saved() {
//   echo "сохранил!";
// }

// Add the code to footer
add_action('wp_footer', 'add_chatra_code');
function add_chatra_code() {
  echo get_option( 'chatra-code' );
}
