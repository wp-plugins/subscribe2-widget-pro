<?php
/**
 *  Admin options page. Creates a page to set your OAuth settings for the Subscribe2 API v2.
 *  A special thanks to the Subscribe2 It plugin for the great code!
 *
 */

register_activation_hook(__FILE__, 'subscribe2_widget_activate');
register_uninstall_hook(__FILE__, 'subscribe2_widget_uninstall');
add_action('admin_init', 'subscribe2_widget_init');
add_action('admin_menu', 'subscribe2_widget_add_options_page');

// Delete options when uninstalled
function subscribe2_widget_uninstall() {
    delete_option('subscribe2_widget_settings');
}

// Run function when plugin is activated
function subscribe2_widget_activate() {
    $options = get_option('subscribe2_widget_settings');

}

// Purely for debugging, do not uncomment this unless you want to delete all your settings
// subscribe2_widget_uninstall();

//Subscribe2 Options Page
function subscribe2_widget_add_options_page() {
    // Add the menu option under Settings, shows up as "Subscribe2 API Settings" (second param)
    $page = add_submenu_page('options-general.php',  //The parent page of this menu
                             'Subscribe2 Widget Pro Settings',  //The Menu Title
                             'Subscribe2 Widget', //The Page Title
                             'manage_options',  // The capability required for access to this item
                             'subscribe2_widget',  // the slug to use for the page in the URL
                             'subscribe2_widget_options_form'); // The function to call to render the page

     /* Using registered $page handle to hook script load */
     add_action('admin_print_scripts-' . $page, 'subscribe2_options_scripts');


}
//Add Subscribe2 Widget Pro option scripts to admin head - will only be loaded on plugin options page
function subscribe2_options_scripts() {
        //register our stylesheet
        wp_register_style('subscribe2_widget_css', WP_PLUGIN_URL . '/subscribe2-widget-pro/style/options.css');
        // It will be called only on plugin admin page, enqueue our stylesheet here
        wp_enqueue_style('subscribe2_widget_css');
}

//Load Widget JS Script ONLY on Widget page
function subscribe2_widget_scripts($hook){
       if($hook == 'widgets.php'){
           wp_enqueue_script('subscribe2_widget_admin_scripts', WP_PLUGIN_URL . '/subscribe2-widget-pro/js/admin-widget.js');
           wp_enqueue_style('subscribe2_widget_admin_css', WP_PLUGIN_URL . '/subscribe2-widget-pro/style/admin-widget.css');
       } else {
           return;
       }
}
add_action('admin_enqueue_scripts','subscribe2_widget_scripts');

//Initiate the Subscribe2 Widget
function subscribe2_widget_init() {
    // Register the subscribe2_widget settings as a group
    register_setting('subscribe2_widget_settings', 'subscribe2_widget_settings');

    //call register settings function
	add_action( 'admin_init', 'subscribe2_widget_options_css' );

    add_action( 'admin_menu', 'my_plugin_admin_menu' );
    add_action( 'admin_init', 'subscribe2_widget_options_scripts' );


}

// Output the subscribe2_widget option setting value
function subscribe2_widget_option($setting, $options) {
    // If the old setting is set, output that
    if (get_option($setting) != '') {
        echo get_option($setting);
    } else if (is_array($options)) {
        echo $options[$setting];
    }
}

// Generate the admin form
function subscribe2_widget_options_form() { ?>

<div class="wrap" xmlns="http://www.w3.org/1999/html">
  <!-- Plugin Title -->
  <div id="icon-plugins" class="icon32"><br>
  </div>
  <h2>Subscribe2 Widget Pro Settings</h2>
  <div class="metabox-holder">
    <div class="postbox-container" style="width:75%">
      <form id="subscribe2-settings" method="post" action="options.php">
        <div id="main-sortables" class="meta-box-sortables ui-sortable">
        <div class="postbox" id="subscribe2-widget-intro">
          <div class="handlediv" title="Click to toggle"><br>
          </div>
          <h3 class="hndle"><span>Subscribe2 Widget Pro Introduction</span></h3>
          <div class="inside">
            <p>Thanks for choosing Subscribe2 Widget Pro! <strong>To start using Subscribe2 Widget Pro you must have the Subscribe2 plugin installed.</strong> Enjoy!</p>
            <div class="adminFacebook">
              <p><strong>Like this plugin?  Give it a like on Facebook:</strong></p>
              <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FWordImpressed%2F130943526946924&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=28" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:28px;" allowTransparency="true"></iframe>
            </div>
          </div>
          <!-- /.inside -->
        </div>
        <!-- /#subscribe2-widget-intro -->

        <div class="postbox" id="subscribe2-widget-options">
          <div class="handlediv" title="Click to toggle"><br>
          </div>
          <h3 class="hndle"><span>Subscribe2 Widget Pro Settings</span></h3>
          <div class="inside">
            <p>Options coming soon...</p>
          </div>
          <!-- /.inside -->
        </div>
        <!-- /#subscribe2-widget-options -->

        <div class="control-group">
          <div class="controls">
            <input class="button-primary" type="submit" name="submit" value="<?php _e('Update'); ?>" />
          </div>
        </div>
      </form>
    </div>
    <!-- /#main-sortables -->
  </div>
  <!-- /.postbox-container -->
  <div class="alignright" style="width:24%">
    <div id="sidebar-sortables" class="meta-box-sortables ui-sortable">
      <div id="subscribe2-widget-pro-support" class="postbox">
        <div class="handlediv" title="Click to toggle"><br>
        </div>
        <h3 class="hndle"><span>Need Support?</span></h3>
        <div class="inside">
          <p>If you have any problems with this plugin or ideas for improvements or enhancements, please use the <a href="http://wordpress.org/support/plugin/subscribe2-widget-pro" target="_blank">Support Forums</a>.</p>
        </div>
        <!-- /.inside -->
      </div>
      <!-- /.subscribe2-widget-pro-support -->

    </div>
    <!-- /#sidebar-sortables -->

  </div>
  <!-- .alignright -->
</div>
<!-- /.metabox-holder -->


<?php
} //end subscribe2_widget_options_form
?>