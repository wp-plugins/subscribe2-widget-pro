<?php
/**
 *  Widget Frontend Output
 *
 * @description: The frontend widget form output
 * @since: 1.0
 * @created: 4/28/13
 */

if(isset($before_widget)) echo $before_widget;

//Hide Widget Title if option enabled
if(!$hide_widget_title == 'hide') {
    if(isset($before_title)) echo $before_title;
    if(isset($title)) echo $title;
    if(isset($after_title)) echo $after_title;
}

//Display Success Message for signed up users (non-AJAX submissions)
if($_POST["subscribe"]){

    echo "<div class='s2w-alert s2w-success'>".$success_message."</div>";

} elseif($_POST["unsubscribe"]){

    echo "<div class='s2w-alert s2w-success'>".$unsubscribe_message."</div>";

} else {
//Show Widget

    //Determine where this form will post data to
    if (!empty($postto) && $postto !== 'home') {
        $postPermalink = get_permalink($postto);
    } elseif( $postto == 'home') {
        $postPermalink = get_bloginfo('wpurl');
    }


     ?>

    <div class="s2w-widget-pro<?php
    //Output Custom DIV class
    if(!empty($div)) {  echo ' '.$div; }; ?>" data-validation-error="<?php echo $validation_message; ?>">

        <?php
        if (!empty($widgetprecontent)) {
            echo wpautop($widgetprecontent);
        }
        ?>

        <form action="<?php echo $postPermalink; ?>" method="post" class="s2w-form">

            <input type="hidden" value="<?php echo s2w_get_IP(); ?>" name="ip">

            <label for="s2email"><?php _e('Your email:','s2w'); ?></label><br><input type="text" onblur="if (this.value == '') {this.value = 'Enter email address...';}" onfocus="if (this.value == 'Enter email address...') {this.value = '';}" size="20" value="Enter email address..." id="s2email" class="s2w-email" name="email">

            <?php if($hide_subscribe_button != 'none') { ?>
                <input type="submit" value="Subscribe" name="subscribe">
            <?php } ?>

            <?php
            /**
             * Show Unsubscribe button if checked
             */
            if($hide_unsubscribe_button == 'show') {?>
               <input type="submit" value="Unsubscribe" name="unsubscribe">
            <?php } ?>

        </form>

        <?php
        if (!empty($widgetpostcontent)) {
            echo wpautop($widgetpostcontent);
        }
        ?>

    </div>

<?php } //end check for $_POST submission  ?>
<?php if(isset($after_widget)) echo $after_widget;  ?>