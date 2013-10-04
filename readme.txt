=== Subscribe2 Widget Pro ===
Contributors: dlocc
Donate link: http://wordimpress.com/
Tags: subscribe2, widget, newsletter, email, newsletter widget, subscribe2 widget
Requires at least: 3.5
Tested up to: 3.6.1
Stable tag: 1.2.5.1

Subscribe2 Widget Pro enhances the capabilities of Subscribe2 via an advanced subscription widget with many additional options.

== Description ==

= Subscribe2 Widget Pro Premium =
[Upgrade to Subscribe2 Widget Pro Premium](http://wordimpress.com/wordpress-plugin-development/subscribe2-widget-pro/ "Upgrade to Subscribe2 Widget Pro Premium")

*Subscribe2 Widget Pro Premium* is a **significant upgrade** to *Subscribe2 Widget Pro* that adds many features and functionalities not found within the default widget! Features include fast AJAX form submission, customizable labels, validation messages and input values, optimized Subscribe2 output, an advanced shortcode and more! Also included is 1-year of priority support, lifetime updates and multisite support.

= Subscribe2 Widget Pro =

Subscribe2 is the leading email subscription plugin for WordPress with more than 1 million downloads. Subscribe2 Widget Pro greatly enhances the standard Subscribe2 widget to provide optimized features and advanced configurations. Easily increase the number of subscribers to your blog by including a better sign up form in your sidebar.

Subscribe2 Widget Pro is actively supported and developed. The open source version is available for free to the WordPress community. For additional options and priority support please consider [upgrading to Subscribe2 Widget Pro Premium](http://wordimpress.com/wordpress-plugin-development/subscribe2-widget-pro/). If you like this plugin please [rate it on WordPress.org](http://wordpress.org/support/view/plugin-reviews/subscribe2-widget-pro/).

= Features =

1. Display a Subscribe2 newsletter sign-up widget on any sidebar
2. Customize the look-and-feel of the widget
3. Easy activation and setup
4. Clean and semantic markup
5. Actively supported and developed

== Installation ==

1. Upload the `subscribe2-widget-pro` folder and it's contents to the `/wp-content/plugins/` directory or install via the WP plugins panel in your WordPress admin dashboard
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it! You should now be able to access the Plugin's options via your settings panel.

Note: If you have Wordpress 2.7 or above you can simply go to 'Plugins' &gt; 'Add New' in the WordPress admin and search for "Subscribe2 Widget Pro" and install it from there.

== Frequently Asked Questions ==

= Why should I use this plugin? =

If you are using the Subscribe2 plugin and want to increase the number of subscribers to your blog and are frustrated with the lack of options and reliability of the standard Subscribe2 Widget then this plugin is for you. Subscribe2 Widget Pro can be placed in any widgetized sidebar to display a subscription form that you can then customize and style to your hearts delight!

= I'm not receiving any emails, what's the deal? =

First, please ensure that your WordPress is sending emails correctly by using [Check Email](http://wordpress.org/plugins/check-email/ "Check Email") or [WP SMTP](http://wordpress.org/plugins/wp-smtp/ "WP SMTP") to test email functionality. If you do not receive emails after testing with either of these plugins then something is up with your WordPress email configuration.

If you have confirmed that your WordPress is sending emails correctly and you are still not receiving subscription notices or tests then it's time to check the widget configuration. Under "Submission Options" check the page that the "Post form content to page" field points to. Does this page contain the Subscribe2 shortcode? If not, the subscription emails will not send. The widget is dependent of having the shortcode on the page that it is pointing to for it to function properly.

Still not working? It's time to open a support ticket with WordImpress so we can check it out: [Subscribe2 Widget Pro Free Support](http://wordimpress.com/support/forum/subscribe2-widget-pro/subscribe2-widget-pro-free-version/ "Subscribe2 Widget Pro Free Support"). Please be prepared to provide a temporary login for us to work with on your site.

= The plugin looks funny in my sidebar, what's the deal? =

Some themes may have very small sidebars and/or CSS styles that alter the appearance of Subscribe2 Widget Pro.


== Screenshots ==

1. Subscribe2 Widget displayed with default Twenty Twelve theme

2. Widget displayed in sidebar without any menu items toggled. This is the default widget appearance and may not reflect the current look of the widget.

3. The widget settings page

== Changelog ==

= 1.2.5.1 =
* Fixed: Issue with unavailable automatic updates and new licensing server

= 1.2.5 =
* New: Added anti-spam feature to widget found in version 9.0 of Subscribe2
* Updated: Thorough testing and debugging of non-AJAX submission methods
* Updated: Reworked email validation regex for email field
* Updated: New Readme FAQ question
* Cleanup: Removed unused is_subscribe2_activated function

= 1.2.2 =
* Updated: Polished upgrade/downgrade code and removed isJSON PHP 5.3+ function for users of older PHP versions
* Updated: Minor readme.txt updates


= 1.2.1 =
* Updated: License communication logic

= 1.2 =
* Fixed "Undefined index" PHP notice
* Added plugin meta links to options page, support and premium downloads
* Updated a few bad links

= 1.1 =
* Release of stable version with premium licensing logic

= 1.0 =
* Initial plugin release
