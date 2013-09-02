<?php
/**
 * @DESC: Subscribe2 Widget Pro licensing logic
 */


if (!class_exists('S2W_Plugin_Licensing')):

    class S2W_Plugin_Licensing {

        private $plugin = 'subscribe2-widget-pro/subscribe2-widget-pro.php';
        private $base_url = 'http://wordimpress.com/';
        private $opensource = 'http://downloads.wordpress.org/plugin/subscribe2-widget-pro.zip';
        private $premium = 'http://wordimpress.com/downloads/files/subscribe2-widget-pro.zip';
        private $productID = 'SUBSCRIBE2-WIDGET-PRO';


        //public function to check for premium license
        public function activate_license($options) {

            if (isset($options["s2w_widget_premium_license"])) $licence_key = $options['s2w_widget_premium_license'];
            if (isset($options["s2w_widget_premium_email"])) $email = $options['s2w_widget_premium_email'];

            $args = array(
                'wc-api' => 'software-api',
                'request' => 'activation',
                'email' => $email,
                'licence_key' => $licence_key,
                'product_id' => $this->productID
            );

            //Execute request (function below)
            $result = $this->execute_request($args);

            //If license is Activated
            if (!empty($result["activated"])) {

                //Save transient variable to check license (saved as current UNIX timestamp)
                $licenseTransient = time();
                set_transient('s2w_widget_license_transient', $licenseTransient, 60 * 60 * 168);

                //Update option license status option
                $options['s2w_widget_premium_license_status'] = "1";
                update_option('s2w_widget_settings', $options);


                //Run Upgrade Func
                $this->upgrade_downgrade($this->premium);

            }

            return $result;

        }

        // Valid deactivation reset request
        public function deactivate_license($options) {

            if (isset($options["s2w_widget_premium_license"])) $licence_key = $options['s2w_widget_premium_license'];
            if (isset($options["s2w_widget_premium_email"])) $email = $options['s2w_widget_premium_email'];

            $args = array(
                'wc-api' => 'software-api',
                'request' => 'deactivation',
                'email' => $email,
                'licence_key' => $licence_key,
                'instance' => '',
                'product_id' => $this->productID
            );

            $result = $this->execute_request($args);

            if ($result['reset'] == true) {
                //Update option license status option and delete license
                $options['s2w_widget_premium_license_status'] = "0";
                $options['s2w_widget_premium_email'] = "";
                $options['s2w_widget_premium_license'] = "";
                update_option('s2w_widget_settings', $options);

                //Run Upgrade Function
                $this->upgrade_downgrade($this->opensource);

            }

            return $result;

        }

        //Check License
        public function check_license() {


        }


        /**
         * Execute Software API Request
         * @param $args
         * @return array|mixed
         */
        public function execute_request($args) {
            //Create request URL
            $target_url = $this->create_url($args);
            $target_url = html_entity_decode($target_url);

            //get data from target_url using WP's built in function
            $data = wp_remote_get($target_url);
            if ($this->isJson($data['body']) == false) {
                $ch = curl_init($target_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data = curl_exec($ch);
                curl_close($ch);
                $message = $data;
            } elseif (is_wp_error($data)) {

                $message = "Something went wrong...";

            } else {

                $message = $data['body'];

            }

            //Return JSON decoded response
            return json_decode($message, true);

        }

        //check if jSON
        // see: http://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php
        public function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }

        // Create an url (used for License activation)
        public function create_url($args) {
            $base_url = add_query_arg('wc-api', 'software-api', $this->base_url);
            return $base_url . '&' . http_build_query($args, '', '&amp;');
        }


        //Determine the status of this users license and apply applicable functions
        public function license_status($options) {

            //grab the license data from the plugin options
            if (isset($options["s2w_widget_premium_license_status"])) $licenseStatus = $options["s2w_widget_premium_license_status"];
            if (isset($options["s2w_widget_premium_license"])) $licenseKey = $options['s2w_widget_premium_license'];
            if (isset($options["s2w_widget_premium_email"])) $licenseEmail = $options['s2w_widget_premium_email'];
            $response = '';

            /*
             *  Newly activated user: 0
             *   if the user has not activated their license ever before
             *   and has inserted an email and license key
             */
            if ($licenseStatus == 0 && !empty($licenseKey) && !empty($licenseEmail)) {
                $response = $this->activate_license($options);
            } //License is activated: 1
            elseif ($licenseStatus == 1) {

                //Check license key
                $response = 'valid';


            } //User is deactivating license: 2
            elseif ($licenseStatus == 2) {

                $response = $this->deactivate_license($options);

            }

            return $response;

        }

        //Display License Responses to User
        public function license_response($response) {
            if (isset($response["activated"])) $status = $response["activated"];
            if (isset($response["code"])) $code = $response["code"];

            //License is good and activated
            if (!empty($status) && $status == true || $response == 'valid') {
                $message = ($response['message'] != "v") ? ' <br/>' . $response['message'] : '';
                $response = __('<div class="license-activated alert alert-success">
               <p><strong>License Activated</strong><br/> Thank you for purchasing Subscribe2 Widget Pro Premium' . $message . '</p>
           </div>', 's2w');
            } //License Key Errors
            elseif (!empty($code)) {

                switch ($code) {
                    case '101' :
                        $error = __('<p><strong>License Invalid</strong><br/> Please check that the license you are using is valid.</p>', 's2w');
                        break;
                    case '103' :
                        $error = __('<p><strong>License Invalid</strong><br/> Exceeded maximum number of activations.</p>', 's2w');
                        break;
                    default :
                        $error = __('<p><strong>Invalid Request</strong><br/> Please <a href="http://wordpress.org/support/plugin/subscribe2-widget-pro" target="_blank">contact support</a> for assistance.</p>', 's2w');
                }

                $response = '<div class="license-activated alert alert-red">' . $error . '</div>';


            } //Deactivated License Key
            elseif (isset($response["reset"]) && $response["reset"] == true) {

                $response = '<div class="license-deactivated alert alert-success">
                       <p><strong>' . __('License Deactivated</strong><br/> Thank you for using Subscribe2 Widget Pro Premium', 's2w') . '</p>
                   </div>';

            } elseif (empty($response)) {

                $response = '<div class="no-license alert alert-info">
                       <p><strong>' . __('Upgrade to Subscribe2 Widget Pro Premium</strong><br/> Features include AJAX form submission, first and last name field support, Subscribe2 frontend script removal and more.', 's2w') . '</p>
                   </div>';


            } //endif

            return $response;


        } //end license_response

        private function upgrade_downgrade($package) {

            include ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            $upgrader = new Plugin_Upgrader();

            $upgrader->init();
            $upgrader->install_strings();
            $upgrader->upgrade_strings();
            $upgrader->run(array(
                'package' => $package,
                'destination' => WP_PLUGIN_DIR,
                'clear_destination' => true,
                'clear_working' => true,
                'hook_extra' => array(
                    'plugin' => $this->plugin
                )
            ));

        }

    }

endif;