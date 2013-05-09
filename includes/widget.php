<?php
/**
 *  Subscribe2 Widget Class
 *
 *  @description: The class that is responsible for the Subscribe2 Widget
 *  @since: 1.0
 *  @created: 4/27/13
 */

class Subscribe2_Widget_Pro extends WP_Widget {

    /**
   	 * Register widget with WordPress.
  	 */
   	public function __construct() {
   		parent::__construct(
   	 		'subscribe2_widget', // Base ID
   			'Subscribe2 Widget Pro', // Name
   			array( 'description' => __( 'Customize and display a Subscribe2 widget anywhere on your site.', 's2w' ), ) // Args
   		);

        //Only Load scripts when widget or shortcode is active
        if ( is_active_widget(false, false, $this->id_base) ){
            add_action('wp_enqueue_scripts', 'add_s2w_widget_frontend_scripts');
        }


   	}


    /**
   	 * Front-end display of widget.
   	 *
   	 * @see WP_Widget::widget()
   	 *
   	 * @param array $args   Widget arguments.
   	 * @param array $instance Saved values from database.
   	 */
    function widget($args, $instance) {

        extract($args);
        $defaultTitle = __('Subscribe to '. get_bloginfo('name'). '','ywp');

        //Subscribe2 Widget Options
        $title                      = empty($instance['title']) ? __($defaultTitle, 'subscribe2_widget_pro') : $instance['title'];
        $div                        = $instance['div'];
        $widgetprecontent           = empty($instance['widgetprecontent']) ? '' : $instance['widgetprecontent'];
        $widgetpostcontent          = empty($instance['widgetpostcontent']) ? '' : $instance['widgetpostcontent'];
        $hide_subscribe_button      = empty($instance['hide_subscribe_button']) ? '' : $instance['hide_subscribe_button'];
        $hide_unsubscribe_button    = empty($instance['hide_unsubscribe_button']) ? '' : $instance['hide_unsubscribe_button'];
        $hide_widget_title    = empty($instance['hide_widget_title']) ? '' : $instance['hide_widget_title'];
        $postto                     = empty($instance['postto']) ? '' : $instance['postto'];
        $validation_message         = empty($instance['validation_message']) ? '' : $instance['validation_message'];
        $success_message            = empty($instance['success_message']) ? '' : $instance['success_message'];
        $unsubscribe_message        = empty($instance['unsubscribe_message']) ? '' : $instance['unsubscribe_message'];
        /*
         * Output Subscribe2 Widget Pro
         */

        /* Debugging */
//        echo '<pre>';
//        var_dump($instance);
//        echo '</pre>';

       include('templates/widget-output.php');

    }


    /**
     * @DESC: Saves the widget options
     * @SEE WP_Widget::update */
    function update($new_instance, $old_instance) {

        $instance                                     = $old_instance;
        $instance['title']                            = strip_tags(stripslashes($new_instance['title']));
        $instance['div']                              = strip_tags(stripslashes($new_instance['div']));
        $instance['widgetprecontent']                 = stripslashes($new_instance['widgetprecontent']);
        $instance['widgetpostcontent']                = stripslashes($new_instance['widgetpostcontent']);
        $instance['hide_subscribe_button']            = strip_tags(stripslashes($new_instance['hide_subscribe_button']));
        $instance['hide_unsubscribe_button']          = strip_tags(stripslashes($new_instance['hide_unsubscribe_button']));
        $instance['hide_widget_title']          = strip_tags(stripslashes($new_instance['hide_widget_title']));
        $instance['postto']                           = stripslashes($new_instance['postto']);
        $instance['validation_message']               = stripslashes($new_instance['validation_message']);
        $instance['success_message']                  = stripslashes($new_instance['success_message']);
        $instance['unsubscribe_message']              = stripslashes($new_instance['unsubscribe_message']);

        return $instance;
    }


   /**
    * Back-end widget form.
    * @see WP_Widget::form()
    */
   function form($instance) {

        // set some defaults, getting any old options first
        $options = get_option('subscribe2_widget_pro');
        $siteName = get_bloginfo('name');
        $defaultTitle = __('Subscribe to '. $siteName .'','s2w');

        if ($options == false) {

            $defaults = array(
                'title'                             => $defaultTitle,
                'div'                               => 'subscribe2-widget-pro',
                'widgetprecontent'                  => '',
                'widgetpostcontent'                 => '',
                'hide_subscribe_button'             => '',
                'hide_unsubscribe_button'           => '',
                'hide_widget_title'                 => '',
                'postto'                            => '',
                'validation_message'                => __('There was a problem with your submission. Errors have been highlighted below.','s2w'),
                'success_message'                   => __('Thank you for signing up! Please check your email to confirm your subscription.','s2w'),
                'unsubscribe_message'               => __('Please check your email to confirm your subscription removal from '.$siteName.'. We are sorry to see you go!','s2w'),

            );

        } else {

            $defaults = array(
                'title'                             => $options['title'],
                'div'                               => $options['div'],
                'widgetprecontent'                  => $options['widgetprecontent'],
                'widgetpostcontent'                 => $options['widgetpostcontent'],
                'hide_subscribe_button'             => $options['hide_subscribe_button'],
                'hide_unsubscribe_button'           => $options['hide_unsubscribe_button'],
                'hide_widget_title'                 => $options['hide_widget_title'],
                'postto'                            => $options['postto'],
                'validation_message'                => $options['validation_message'],
                'success_message'                   => $options['success_message'],
                'unsubscribe_message'               => $options['unsubscribe_message']
            );

            delete_option('subscribe2_widget_pro');

        }

        // code to obtain old settings too
        $instance = wp_parse_args($instance, $defaults);

        $title                          = htmlspecialchars($instance['title'], ENT_QUOTES);
        $div                            = htmlspecialchars($instance['div'], ENT_QUOTES);
        $widgetprecontent               = htmlspecialchars($instance['widgetprecontent'], ENT_QUOTES);
        $widgetpostcontent              = htmlspecialchars($instance['widgetpostcontent'], ENT_QUOTES);
        $hide_subscribe_button          = htmlspecialchars($instance['hide_subscribe_button'], ENT_QUOTES);
        $hide_unsubscribe_button        = htmlspecialchars($instance['hide_unsubscribe_button'], ENT_QUOTES);
        $hide_widget_title              = htmlspecialchars($instance['hide_widget_title'], ENT_QUOTES);
        $postto                         = htmlspecialchars($instance['postto'], ENT_QUOTES);
        $validation_message             = htmlspecialchars($instance['validation_message'], ENT_QUOTES);
        $success_message                = htmlspecialchars($instance['success_message'], ENT_QUOTES);
        $unsubscribe_message            = htmlspecialchars($instance['unsubscribe_message'], ENT_QUOTES);

        global $wpdb, $mysubscribe2;

        /**
         *  Get the widget admin form
         */
        include('templates/widget-admin-form.php');

        //End Form Output

   }

}

/*
 * @DESC: Register Twitter Widget Pro widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "Subscribe2_Widget_Pro" );' ) );