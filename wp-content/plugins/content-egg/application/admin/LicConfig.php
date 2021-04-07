<?php

namespace ContentEgg\application\admin;

defined('\ABSPATH') || exit;

use ContentEgg\application\components\Config;
use ContentEgg\application\Plugin;

/**
 * LicConfig class file
 *
 * @author keywordrush.com <support@keywordrush.com>
 * @link http://www.keywordrush.com/
 * @copyright Copyright &copy; 2015 keywordrush.com
 */
class LicConfig extends Config {

    public function page_slug()
    {
        if ($this->option('license_key') || \get_option(Plugin::slug . '_env_install'))
            return Plugin::slug . '-lic';
        else
            return Plugin::slug;
    }

    public function option_name()
    {
        return Plugin::slug . '_lic';
    }

    public function add_admin_menu()
    {
        
       
    }

    protected function options()
    {
        return array(
            'license_key' => array(
                'title' => __('License key', 'content-egg'),
                'description' => __('Here you must enter a valid license key. You can find key in your <a href="http://www.keywordrush.com/en/panel">user panel</a>. If you don\'t have a key you can buy it on <a href="http://www.keywordrush.com/en/contentegg">the official website</a> of the plugin.', 'content-egg'),
                'callback' => array($this, 'render_input'),
                'default' => '',
                'validator' => array(
                    'trim',
                    array(
                        'call' => array('\ContentEgg\application\helpers\FormValidator', 'required'),
                        'message' => __('The "License key" can not be empty', 'content-egg'),
                    ),
                    array(
                        'call' => array($this, 'licFormat'),
                        'message' => __('Invalid license key', 'content-egg'),
                    ),
                    array(
                        'call' => array($this, 'activatingLicense'),
                        'message' =>
                        __('License key is not accepted. Make sure that you use actual key.', 'content-egg') .
                        ' ' .
                        __('If you have correct key, but it\'s not accepted, this means that your server blocks external connections or there is any other reason that your server doesn\'t allow to connect to keywordrush.com site.', 'content-egg') .
                        ' ' .
                        __('Please, write about this to your hosting provider.', 'content-egg') .
                        ' ' .
                        __('If you need our help, write to <a href="http://www.keywordrush.com/en/contact">our support</a>.', 'content-egg'),
                    ),
                ),
                'section' => 'default',
            ),
        );
    }

    public function settings_page()
    {
        PluginAdmin::render('lic_settings', array('page_slug' => $this->page_slug()));
    }

    public function licFormat($value)
    {
        return true;

    }

    public function activatingLicense($value)
    {
        return true;

        $response = Plugin::apiRequest(array('method' => 'POST', 'timeout' => 15, 'httpversion' => '1.0', 'blocking' => true, 'headers' => array(), 'body' => array('cmd' => 'activate', 'key' => $value, 'd' => parse_url(site_url(), PHP_URL_HOST), 'p' => Plugin::product_id, 'v' => Plugin::version()), 'cookies' => array()));
       
        $result = json_decode(\wp_remote_retrieve_body($response), true);
		$result['status'] = 'valid';

     
       return true;
       
    }

    private function resetLicense()
    {
        
            return true;

            if (!current_user_can('delete_plugins') || empty($_POST['nonce_reset']) || !\wp_verify_nonce($_POST['nonce_reset'], 'license_reset'))
                \wp_die('You don\'t have access to this page.');

            $redirect_url = \get_admin_url(\get_current_blog_id(), 'admin.php?page=content-egg-lic');

            $response = Plugin::apiRequest(array('method' => 'POST', 'timeout' => 15, 'httpversion' => '1.0', 'blocking' => true, 'headers' => array(), 'body' => array('cmd' => 'deactivate', 'key' => $this->option('license_key'), 'd' => parse_url(site_url(), PHP_URL_HOST), 'p' => Plugin::product_id, 'v' => Plugin::version()), 'cookies' => array()));
            if (!$response)
                $redirect_url = AdminNotice::add2Url($redirect_url, 'license_reset_error', 'error');
            $result = json_decode(\wp_remote_retrieve_body($response), true);

            if ($result && !empty($result['status']) && $result['status'] === 'valid')
            {
                \delete_option(LicConfig::getInstance()->option_name());
                $redirect_url = AdminNotice::add2Url($redirect_url, 'license_reset_success', 'warning');
            } else
                $redirect_url = AdminNotice::add2Url($redirect_url, 'license_reset_error', 'error');

            \wp_redirect($redirect_url);
            exit;
        
    }

}
