<?php
/*
Plugin Name: Endereco Adress-Services für WordPress (WooCommerce)
Plugin URI: https://endereco.de/wordpress
Description: Internationale Adressprüfungen für WordPress (WooCommerce)
Text Domain: endereco-wp5-client
Domain Path: /translations
Author: Ilja Weber
Version: 0.0.6
Author URI: https://endereco.de/wordpress
*/

define('ENDERECO_CLIENT_VERSION', '0.0.6');
define('ENDERECO_CLIENT_NAME', 'Endereco WordPress5 Client');

function ewp5c_add_bundle_to_footer() {
    // Get whitelistet page id's.

    // Display only in checkout or address pages.
    if (
        function_exists( 'is_checkout' ) && is_checkout() ||
        function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'edit-address' ) ||
        ewp5c_is_whitelisted_page()
    ) {
        $url = plugin_dir_url( __FILE__ ) . 'assets/js/endereco.min.js';
        include 'chunks/bundle.php';
    }
}
add_action( 'wp_footer', 'ewp5c_add_bundle_to_footer' );

function ewp5c_add_config_to_header() {
    // Get whitelisted page id's

    // Display only in checkout or address pages.
    if (
        function_exists( 'is_checkout' ) && is_checkout() ||
        function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'edit-address' ) ||
        ewp5c_is_whitelisted_page()
    ) {
        include 'chunks/config.php';
    }

    if (
        function_exists( 'is_checkout' ) && is_checkout()
    ) {
        if (is_plugin_active('checkout-for-woocommerce/checkout-for-woocommerce.php')) {
            include 'chunks/wcCheckoutInitAms.php';
        } else {
            include 'chunks/defaultInitAms.php';
        }
    }

    if (
        function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'edit-address' )
    ) {
        include 'chunks/defaultInitAms.php';
    }

}
add_action( 'wp_head', 'ewp5c_add_config_to_header' );

function ewp5c_is_whitelisted_page() {
    global $post;
    $post_id = $post->ID;
    $whitelist = array_map('intval', explode(',', get_option('ewp5c_whitelisted_pages')));

    return in_array($post_id, $whitelist);
}

function ewp5c_change_fields_order(  $fields ) {
    $fields['country']['priority'] = 40;
    $fields['state']['priority'] = 50;
    $fields['postcode']['priority'] = 60;
    $fields['city']['priority'] = 65;
    $fields['address_1']['priority'] = 70;
    $fields['address_2']['priority'] = 80;

    return $fields;
}
add_filter( 'woocommerce_default_address_fields' , 'ewp5c_change_fields_order', 99999);


function ewp5c_register_settings() {

    // Api Key Setting.
    add_option( 'ewp5c_api_key', '');
    register_setting( 'ewp5c_options_group', 'ewp5c_api_key' );

    // API Url Setting.
    add_option( 'ewp5c_api_endpoint_url', 'https://endereco-service.de/rpc/v1');
    register_setting( 'ewp5c_options_group', 'ewp5c_api_endpoint_url' );

    // Activate AMS.
    add_option( 'ewp5c_activate_ams', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_ams' );

    // Allow to close modal.
    add_option( 'ewp5c_allow_close_modal', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_allow_close_modal' );

    // Allow to close modal.
    add_option( 'ewp5c_preselect_country', '0');
    register_setting( 'ewp5c_preselect_country', 'ewp5c_preselect_country' );

    // Demand confirmation of falty address.
    add_option( 'ewp5c_allow_demand_address_confirmation', '0');
    register_setting( 'ewp5c_options_group', 'ewp5c_allow_demand_address_confirmation' );

    // Activate ES.
    add_option( 'ewp5c_activate_es', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_es' );

    // Activate ES.
    add_option( 'ewp5c_show_es_statuses', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_show_es_statuses' );

    // Activate PS.
    add_option( 'ewp5c_activate_ps', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_ps' );

    // Activate PS EX.
    add_option( 'ewp5c_activate_ps_ex', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_ps_ex' );

    // Activate PhS.
    add_option( 'ewp5c_activate_phs', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_phs' );

    // Activate PhS status
    add_option( 'ewp5c_activate_phs_status', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_phs_status' );

    // Activate PhS format
    add_option( 'ewp5c_activate_phs_phone_format', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_activate_phs_phone_format' );

    // Use default css.
    add_option( 'ewp5c_use_standard_css', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_use_standard_css' );

    // Trigger addresscheck on submit.
    add_option( 'ewp5c_trigger_on_submit', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_trigger_on_submit' );

    // Trigger addresscheck on blur.
    add_option( 'ewp5c_trigger_on_blur', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_trigger_on_blur' );

    // Resume submit after the addresscheck.
    add_option( 'ewp5c_resume_after_submit', '1');
    register_setting( 'ewp5c_options_group', 'ewp5c_resume_after_submit' );

    // Resume submit after the addresscheck.
    add_option( 'ewp5c_whitelisted_pages', '');
    register_setting( 'ewp5c_options_group', 'ewp5c_whitelisted_pages' );
}
add_action( 'admin_init', 'ewp5c_register_settings' );

function ewp5c_register_options_page() {
    add_options_page(__('Endereco Plugin Einstellungen', 'endereco-wp5-client'), __('Endereco AMS', 'endereco-wp5-client'), 'manage_options', 'ewp5c', 'ewp5c_option_page');
}

function ewp5c_option_page()
{
    include 'chunks/settings.php';
}

add_action('admin_menu', 'ewp5c_register_options_page');


add_filter( 'plugin_action_links_endereco-wp5-client/endereco-wp5-client.php', 'ewp5c_settings_link' );
function ewp5c_settings_link( $links ) {
    // Build and escape the URL.
    $url = esc_url( add_query_arg(
        'page',
        'ewp5c',
        get_admin_url() . 'options-general.php'
    ) );
    // Create the link.
    $settings_link = "<a href='$url'>" . __( 'Einstellungen', 'endereco-wp5-client' ) . '</a>';
    $api_link = "<a href='https://www.endereco.de/woocommerce' target='_blank'>" . __( 'API-Key beantragen', 'endereco-wp5-client' ) . '</a>';
    // Adds the link to the end of the array.
    array_push(
        $links,
        $settings_link,
        $api_link
    );
    return $links;
}

add_action( 'woocommerce_after_save_address_validation', 'ewp5c_find_and_close_sessions' );
add_action( 'wc_ajax_checkout', 'ewp5c_find_and_close_sessions');
add_action( 'cfw_before_process_checkout', 'ewp5c_find_and_close_sessions');

function ewp5c_find_and_close_sessions() {
    $sApiKy = get_option('ewp5c_api_key');
    $anyDoAccounting = false;
    if ($_POST && !empty($sApiKy)) {
        foreach ($_POST as $sVarName => $sVarValue) {
            if ((strpos($sVarName, '_session_counter') !== false) && 0 < intval($sVarValue)) {
                $sSessionIdName = str_replace('_session_counter', '', $sVarName) . '_session_id';
                $sSessionId = $_POST[$sSessionIdName];

                try {
                    $message = array(
                        'jsonrpc' => '2.0',
                        'id' => 1,
                        'method' => 'doAccounting',
                        'params' => array(
                            'sessionId' => $sSessionId,
                        )
                    );
                    $newHeaders = array(
                        'Content-Type' => 'application/json',
                        'X-Auth-Key' => $sApiKy,
                        'X-Transaction-Id' => $sSessionId,
                        'X-Transaction-Referer' => $_SERVER['HTTP_REFERER'],
                        'X-Agent' => ENDERECO_CLIENT_NAME .' v' . ENDERECO_CLIENT_VERSION,
                    );
                    ewp5c_send_request($message, $newHeaders);
                    $anyDoAccounting = true;

                } catch(\Exception $e) {
                    // Do nothing.
                }
            }

        }
    }

    if ($anyDoAccounting) {
        try {
            $message = array(
                'jsonrpc' => '2.0',
                'id' => 1,
                'method' => 'doConversion',
                'params' => array()
            );
            $newHeaders = array(
                'Content-Type' => 'application/json',
                'X-Auth-Key' => $sApiKy,
                'X-Transaction-Id' => 'not_required',
                'X-Transaction-Referer' => $_SERVER['HTTP_REFERER'],
                'X-Agent' => ENDERECO_CLIENT_NAME .' v' . ENDERECO_CLIENT_VERSION,
            );
            ewp5c_send_request($message, $newHeaders);
        } catch(\Exception $e) {
            // Do nothing.
        }
    }
}

function ewp5c_send_request($body, $headers) {
    $serviceUrl = get_option('ewp5c_api_endpoint_url');
    $ch = curl_init(trim($serviceUrl));
    $dataString = json_encode($body);

    $parsedHeaders = array();
    foreach ($headers as $headerName=>$headerValue) {
        $parsedHeaders[] = $headerName . ': ' . $headerValue;
    }
    $parsedHeaders[] = 'Content-Length: ' . strlen($dataString);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
    curl_setopt($ch, CURLOPT_TIMEOUT, 6);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        $parsedHeaders
    );

    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return $result;
}

function ewp5c_generate_session_id(){
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function ewp5c_connection_works() {
    $sApiKy = get_option('ewp5c_api_key');
    $return = false;
    try {
        $message = array(
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'readinessCheck',
            'params' => array()
        );
        $newHeaders = array(
            'Content-Type' => 'application/json',
            'X-Auth-Key' => $sApiKy,
            'X-Transaction-Id' => 'not_required',
            'X-Transaction-Referer' => $_SERVER['HTTP_REFERER'],
            'X-Agent' => ENDERECO_CLIENT_NAME .' v' . ENDERECO_CLIENT_VERSION,
        );
        $result = ewp5c_send_request($message, $newHeaders);
        if (!empty($result['result']) && ('ready' === $result['result']['status'])) {
            $return = true;
        }
    } catch(\Exception $e) {
        // Do nothing.
    }

    return $return;
}
