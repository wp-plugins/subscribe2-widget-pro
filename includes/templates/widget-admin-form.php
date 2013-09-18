<?php
/**
 *  Widget Form
 *
 * @description: The backend widget form output
 * @since: 1.0
 * @created: 4/28/13
 */
?>

<p>
    <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Widget Title', 's2w'); ?>:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
</p><!-- /Widget Title -->


<h4 class="s2w-toggler"><?php _e('Display Options:', 'ywp'); ?><span></span></h4>

<div class="display-options toggle-item">

    <p>
        <label for="<?php echo $this->get_field_name('widgetprecontent'); ?>"><?php _e('Pre-Content', 's2w');  ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This content will appear BEFORE the opt-in form. HTML is allowed.  Note, content is run through wpautop function prior to output.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
        <textarea class="widefat" id="<?php echo $this->get_field_name('widgetprecontent'); ?>" name="<?php echo $this->get_field_name('widgetprecontent'); ?>" rows="2" cols="25"><?php echo $widgetprecontent; ?></textarea>
    </p><!-- /Pre-Content Size -->


    <p>
        <label for="<?php echo $this->get_field_name('widgetpostcontent'); ?>"><?php _e('Post-Content', 's2w'); ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This content will appear AFTER the opt-in form. Again, HTML is allowed. Note, content is run through wpautop function prior to output.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('widgetpostcontent'); ?>" name="<?php echo $this->get_field_name('widgetpostcontent'); ?>" rows="2" cols="25"><?php echo $widgetpostcontent; ?></textarea>
    </p><!-- /Pre-Content Size -->

    <p>
        <input id="<?php echo $this->get_field_id('hide_subscribe_button'); ?>" name="<?php echo $this->get_field_name('hide_subscribe_button'); ?>" type="checkbox" value="none" <?php echo checked('none', $hide_subscribe_button, false); ?> />
        <label for="<?php echo $this->get_field_id('hide_subscribe_button'); ?>"><?php _e('Hide Subscribe button', 's2w'); ?><img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('Hide the subscribe button on the frontend. Helpful if you would like the form to be an <strong>unsubscribe-only</strong> form. Be sure you have the <em>Show Unsubscribe Button</em> option checked if this option is enabled.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
    </p>

    <p>
        <input id="<?php echo $this->get_field_id('hide_unsubscribe_button'); ?>" name="<?php echo $this->get_field_name('hide_unsubscribe_button'); ?>" type="checkbox" value="show" <?php echo checked('show', $hide_unsubscribe_button, false); ?>/>
        <label for="<?php echo $this->get_field_id('hide_unsubscribe_button'); ?>"><?php _e('Show Unsubscribe button', 's2w'); ?><img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('Display the unsubscribe button.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
    </p><!-- /.display options -->


    <p>
        <input id="<?php echo $this->get_field_id('hide_widget_title'); ?>" name="<?php echo $this->get_field_name('hide_widget_title'); ?>" type="checkbox" value="hide" <?php echo checked('hide', $hide_widget_title, false); ?>/>
        <label for="<?php echo $this->get_field_id('hide_widget_title'); ?>"><?php _e('Hide widget title', 's2w'); ?><img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('Hide the widget heading. This option may be useful for some themes.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
    </p><!-- /.display options -->


</div>
<!-- /.display-options -->


<h4 class="s2w-toggler"><?php _e('Submission Options:', 'ywp'); ?><span></span></h4>

<div class="submission-options toggle-item">


<p>
    <label for="<?php echo $this->get_field_name('postto'); ?>"><?php _e('Post form content to page', 's2'); ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This is the page the opt-in form will post the form data and redirect the user to.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
    <select class="widefat" id="<?php echo $this->get_field_id('postto'); ?>" name="<?php echo $this->get_field_name('postto'); ?>">
        <?php global $mysubscribe2; ?>
        <option value="<?php echo $mysubscribe2->subscribe2_options['s2page']; ?>"><?php _e('Use Subscribe2 default', 's2w'); ?></option>
        <option value="home" <?php if ($postto === 'home') {
            echo 'selected="selected"';
        } ?>>

            <?php _e('Use Home Page', 's2w'); ?></option>
        <?php $mysubscribe2->pages_dropdown($postto); ?>
    </select>

</p><!-- /Post form content to page -->

    <p><em><?php _e('Advanced AJAX form submission is only available in the Premium version of Subscribe2 Widget Pro.','s2w'); ?></em><img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('AJAX provides a more seamless user experience by elimating the need for page reload.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></p>

    <p>
          <label for="<?php echo $this->get_field_name('validation_message'); ?>"><?php _e('Validation message', 's2w');  ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This is the message that appears when a user submits the newsletter form with incorrect data.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
          <textarea class="widefat" id="<?php echo $this->get_field_name('validation_message'); ?>" name="<?php echo $this->get_field_name('validation_message'); ?>" rows="2" cols="25"><?php echo $validation_message; ?></textarea>
      </p><!-- /validation_message -->

      <p>
          <label for="<?php echo $this->get_field_name('success_message'); ?>"><?php _e('Success message', 's2w');  ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This is the message that appears upon successful form submit.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
          <textarea class="widefat" id="<?php echo $this->get_field_name('success_message'); ?>" name="<?php echo $this->get_field_name('success_message'); ?>" rows="2" cols="25"><?php echo $success_message; ?></textarea>
      </p><!-- /validation_message -->
      <p>
          <label for="<?php echo $this->get_field_name('unsubscribe_message'); ?>"><?php _e('Unsubscribe message', 's2w');  ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('This is the message that appears for users who have elected to unsubscribe.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
          <textarea class="widefat" id="<?php echo $this->get_field_name('unsubscribe_message'); ?>" name="<?php echo $this->get_field_name('unsubscribe_message'); ?>" rows="2" cols="25"><?php echo $unsubscribe_message; ?></textarea>
      </p><!-- /validation_message -->


</div><!--/.submission-options -->


<h4 class="s2w-toggler"><?php _e('Advanced Options:', 'ywp'); ?><span></span></h4>

<div class="advanced-options toggle-item">


    <p>
        <label for="<?php echo $this->get_field_name('div'); ?>"><?php echo  __('Custom container class', 's2w'); ?>:<img src="<?php echo S2W_WIDGET_PRO_URL . '/includes/images/help.png' ?>" title="<?php _e('A custom container class allows you to add additional styles to the frontend widget using CSS.', 's2w'); ?>" class="tooltip-info" width="16" height="16"/></label>
        <input class="widefat" id="<?php echo $this->get_field_id('div'); ?>" name="<?php echo $this->get_field_name('div'); ?>" type="text" value="<?php echo $div; ?>"/>
    </p><!-- /Custom Container Class -->


</div>
<!-- /.advanced-options -->


<div class="pro-option">
<p>Upgrade to the <a href="<?php echo S2W_WIDGET_UPGRADE_LINK; ?>" target="_blank" class="new-window" title="<?php _e('Get immediate access after purchase to additional features, priority support and lifetime updates.','ywp'); ?>"><?php _e('Premium Version','s2w'); ?></a></p>
</div>