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
   			array( 'description' => __( 'Customize and display a Subscribe2 widget anywhere on your site.', 'text_domain' ), ) // Args
   		);
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
        $defaultTitle = "Subscribe to ". get_bloginfo('name');

        //Subscribe2 Widget Options
        $title                 = empty($instance['title']) ? __($defaultTitle, 'subscribe2_widget_pro') : $instance['title'];
        $title                 = empty($instance['title']) ? __('Subscribe2', 'subscribe2_widget_pro') : $instance['title'];
        $div                   = empty($instance['div']) ? 'subscribe2-widget-pro' : $instance['div'];
        $widgetprecontent      = empty($instance['widgetprecontent']) ? '' : $instance['widgetprecontent'];
        $widgetpostcontent     = empty($instance['widgetpostcontent']) ? '' : $instance['widgetpostcontent'];
        $hidebutton            = empty($instance['hidebutton']) ? 'none' : $instance['hidebutton'];
        $postto                = empty($instance['postto']) ? '' : $instance['postto'];
        $textbox_size          = empty($instance['size']) ? 20 : $instance['size'];

        /*
         * Output Subscribe2 Widget Pro
         */

        /* Debugging */
//        echo '<pre>';
//        var_dump($instance);
//        echo '</pre>';

        $hide = '';
        if ( $hidebutton == 'subscribe' || $hidebutton == 'unsubscribe' ) {
            $hide = " hide=\"" . $hidebutton . "";
        } elseif ( $hidebutton == 'link' ) {
            $hide = " link=\"" . __('(Un)Subscribe to Posts', 'subscribe2_widget_pro') . "\"";
        }
        $postid = '';
        if ( !empty($postto) || $postto !== 'home' ) {
            $postid = " id=\"" . $postto . "\"";
        }
        $size = " size=\"" . $textbox_size . "\"";
        $shortcode = "[subscribe2" . $hide . $postid . $size . "]";

        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo "<div class=\"" . $div . "\">";
        $content = do_shortcode( $shortcode );
        if ( !empty($widgetprecontent) ) {
            echo $widgetprecontent;
        }
        echo $content;
        if ( !empty($widgetpostcontent) ) {
            echo $widgetpostcontent;
        }
        echo "</div>";
        echo $after_widget;

    }


    /**
     * @DESC: Saves the widget options
     * @SEE WP_Widget::update */
    function update($new_instance, $old_instance) {

        $instance                         = $old_instance;
        $instance['title']                = strip_tags(stripslashes($new_instance['title']));
        $instance['div']                  = strip_tags(stripslashes($new_instance['div']));
        $instance['widgetprecontent']     = stripslashes($new_instance['widgetprecontent']);
        $instance['widgetpostcontent']    = stripslashes($new_instance['widgetpostcontent']);
        $instance['hidebutton']           = strip_tags(stripslashes($new_instance['hidebutton']));
        $instance['postto']               = stripslashes($new_instance['postto']);
        $instance['size']                 = intval(stripslashes($new_instance['size']));

        return $instance;
    }


   /**
    * Back-end widget form.
    * @see WP_Widget::form()
    */
   function form($instance) {

        // set some defaults, getting any old options first
        $options = get_option('subscribe2_widget_pro');
        $defaultTitle = "Subscribe to ". get_bloginfo('name');

        if ($options == false) {

            $defaults = array(
                'title'                 => $defaultTitle,
                'div'                   => 'subscribe2-widget-pro',
                'widgetprecontent'      => '',
                'widgetpostcontent'     => '',
                'hidebutton'            => 'none',
                'postto'                => '',
                'size'                  => 20
            );

        } else {

            $defaults = array(
                'title'                 => $options['title'],
                'div'                   => $options['div'],
                'widgetprecontent'      => $options['widgetprecontent'],
                'widgetpostcontent'     => $options['widgetpostcontent'],
                'hidebutton'            => $options['hidebutton'],
                'postto'                => $options['postto'],
                'size'                  => $options['size']
            );

            delete_option('subscribe2_widget_pro');

        }

        // code to obtain old settings too
        $instance = wp_parse_args($instance, $defaults);

        $title               = htmlspecialchars($instance['title'], ENT_QUOTES);
        $div                 = htmlspecialchars($instance['div'], ENT_QUOTES);
        $widgetprecontent    = htmlspecialchars($instance['widgetprecontent'], ENT_QUOTES);
        $widgetpostcontent   = htmlspecialchars($instance['widgetpostcontent'], ENT_QUOTES);
        $hidebutton          = htmlspecialchars($instance['hidebutton'], ENT_QUOTES);
        $postto              = htmlspecialchars($instance['postto'], ENT_QUOTES);
        $size                = htmlspecialchars($instance['size'], ENT_QUOTES);

        global $wpdb, $mysubscribe2;
        $sql = "SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish'";
        ?>

        <div>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php echo __('Widget Title', 'subscribe2_widget_pro'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <!-- /Widget Title -->

        <p>
            <label for="<?php echo $this->get_field_name('div'); ?>"><?php echo  __('Custom Container Class', 'subscribe2_widget_pro'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('div'); ?>" name="<?php echo $this->get_field_name('div'); ?>" type="text" value="<?php echo $div; ?>" />
        </p>
        <!-- /Custom Container Class -->

        <p>
            <label for="<?php echo $this->get_field_name('widgetprecontent');  ?>"><?php echo __('Pre-Content', 'subscribe2_widget_pro');  ?>:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_name('widgetprecontent'); ?>" name="<?php echo $this->get_field_name('widgetprecontent'); ?>" rows="2" cols="25"><?php echo $widgetprecontent; ?></textarea>
        </p>
        <!-- /Pre-Content Size -->

        <p>
           <label for="<?php echo $this->get_field_name('widgetpostcontent'); ?>"><?php echo __('Post-Content', 'subscribe2_widget_pro'); ?>:</label>
           <textarea class="widefat" id="<?php echo $this->get_field_id('widgetpostcontent'); ?>" name="<?php echo $this->get_field_name('widgetpostcontent'); ?>" rows="2" cols="25"><?php echo $widgetpostcontent ; ?></textarea>
        </p>
        <!-- /Pre-Content Size -->

        <p>
           <label for="<?php echo $this->get_field_name('size'); ?>"><?php echo __('Text Box Size', 'subscribe2_widget_pro'); ?>:</label>
           <input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php echo $size ; ?>" />
        </p>
        <!-- /.Post-Content Size -->

        <p>
            <label for="<?php echo $this->get_field_name('hidebutton'); ?>"><?php echo __('Display options', 'subscribe2_widget_pro'); ?>:</label><br />
            <input name="<?php echo $this->get_field_name('hidebutton'); ?>" type="radio" value="none" <?php echo checked('none', $hidebutton, false); ?>/><?php echo __('Show complete form', 'subscribe2_widget_pro'); ?><br />
            <input name="<?php echo $this->get_field_name('hidebutton'); ?>" type="radio" value="subscribe" <?php echo checked('subscribe', $hidebutton, false); ?>"/><?php echo __('Hide Subscribe button', 'subscribe2_widget_pro'); ?><br />
            <input name="<?php echo $this->get_field_name('hidebutton'); ?>" type="radio" value="unsubscribe" <?php echo checked('unsubscribe', $hidebutton, false); ?>/><?php echo __('Hide Unsubscribe button', 'subscribe2_widget_pro'); ?>

       <?php if ($mysubscribe2->subscribe2_options['ajax'] == '1') {  ?>
           <br /><input name="<?php echo $this->get_field_name('hidebutton'); ?>" type="radio" value="link" <?php echo checked('link', $hidebutton, false); ?>/><?php echo __('Show as link', 'subscribe2_widget_pro'); ?>
       <?php } ?>
       </p>
       <!-- /.display options -->

       <p><label for="<?php echo $this->get_field_name('postto'); ?>"><?php echo __('Post form content to page', 'subscribe2_widget_pro'); ?>:</label>
       <select class="widefat" id="<?php echo $this->get_field_id('postto'); ?>" name="<?php echo $this->get_field_name('postto'); ?>">
       <?php global $mysubscribe2; ?>
       <option value="<?php echo $mysubscribe2->subscribe2_options['s2page']; ?>"><?php echo __('Use Subscribe2 Default', 'subscribe2_widget_pro'); ?></option>
       <option value="home">
       <?php if ( $postto === 'home' ) { echo 'selected="selected"'; } ?>
       <?php echo __('Use Home Page', 'subscribe2_widget_pro'); ?></option>
       <?php $mysubscribe2->pages_dropdown($postto); ?>
       </select></p>
        <!-- /Post form content to page -->


       </div>

   <?php //End Form Output
   }

}

/*
 * @DESC: Register Twitter Widget Pro widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "Subscribe2_Widget_Pro" );' ) );