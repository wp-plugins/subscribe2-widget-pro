<?php
/**
 * @DESC: Licensing Metabox
 */
global $options;
?>

<div id="s2w-widget-pro-premium" class="postbox">
    <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Subscribe2 Widget Pro Premium', 's2w'); ?></span></h3>

    <div class="inside">
        <?php

        /**
          *  Premium License Logic - No Obfuscation Here
          *  Stealing isn't nice... please respect our work and purchase a license rather than hacking :)
          */
        is_s2w_license_active();
        //Check license logic
        $licensing = new S2W_Plugin_Licensing();
        $options = get_option('s2w_widget_settings');
        $response = $licensing->license_status($options);

        //Current License Status
        $licenseStatus = $options["s2w_widget_premium_license_status"];

        //Activated
        if( isset($response["activated"])) $status = $response["activated"];
        if( isset($response["code"]) ) $code = $response["code"]; ?>

        <form id="s2w-license" method="post" action="options.php">

        <?php //Display appropriate notifications to the user
             echo $licensing->license_response($response);  ?>

        <div class="control-group">
            <p><?php _e('If you have purchased a license for Subscribe2 Widget Pro Premium you may enter it in below to enable premium features:', 's2w'); ?></p>
            <div class="control-label">
                  <label for="s2w_widget_premium_email"><?php _e('License Email','s2w'); ?><img src="<?php echo S2W_WIDGET_PRO_URL.'/includes/images/help.png'?>" title="<?php _e('This is the address you purchased the license key with and received email confirmation.', 's2w'); ?>" class="tooltip-info" width="16" height="16" /></label>
            </div>

            <div class="controls">
                <input type="text" id="s2w_widget_premium_email" name="s2w_widget_settings[s2w_widget_premium_email]" placeholder="your.email@email.com" value="<?php echo s2w_widget_option('s2w_widget_premium_email', $options); ?>" />
                <!-- hidden license status field -->
                <input type="hidden" id="s2w_widget_premium_license_status" name="s2w_widget_settings[s2w_widget_premium_license_status]" value="<?php echo $licenseStatus;  ?>" />
            </div>
        </div><!--/.control-group -->
        <div class="control-group">
            <div class="control-label">
                <label for="s2w_widget_premium_license"><?php _e('License Key','s2w'); ?><img src="<?php echo S2W_WIDGET_PRO_URL.'/includes/images/help.png'?>" title="<?php _e('The license key can be found in your confirmation email. If you lost your license you can <a href=\'http://wordimpress.com/lost-licence/\'>request it sent by email</a>.', 's2w'); ?>" class="tooltip-info" width="16" height="16" /></label>
            </div>

            <div class="controls">
                <input type="text" id="s2w_widget_premium_license" name="s2w_widget_settings[s2w_widget_premium_license]" placeholder="s2w-" value="<?php echo s2w_widget_option('s2w_widget_premium_license', $options); ?>"/>
            </div>

        </div><!--/.control-group -->


        <div class="control-group">
           <div class="controls">
               <?php
               //Output appropriate Submit Button
               if($licenseStatus == 1){ ?>

                   <input class="button" id="deactivate" type="submit" name="submit-button" value="<?php _e('Deactivate'); ?>" />

                <?php } else { ?>

                   <input class="button" id="activate" type="submit" name="submit-button" value="<?php _e('Activate'); ?>" />

                <?php } ?>

           </div>
       </div>


    </div><!-- /.inside -->
</div><!-- /.s2w-widget-pro-support -->