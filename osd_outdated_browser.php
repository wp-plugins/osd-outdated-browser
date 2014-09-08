<?php
/**
 * Plugin Name: OSD Outdated Browser
 * Plugin URI: http://outsidesource.com
 * Description: Notifies users that they are using an outdated browser.
 * Version: 1.2
 * Author: OSD Web Development Team
 * Author URI: http://outsidesource.com
 * License: GPL2v2
 */


/**
 * Widget class for notifying users that they are using an outdated browser
 * ----------------------------------------------------------------------------
 */

class OSD_Outdated_Browser extends WP_Widget {
    // Widget Constructor
    public function __construct() {
        parent::__construct(
            'osd_outdated_browser_widget',
            'OSD Outdated Browser',
            array('description' => __('Add a banner for outdated browsers.'))
        );

        // Set options
        $this->options = get_option('osd_outdated_browser_options');
        $this->options['message'] = get_option('osd_outdated_browser_message');
        
        // Only load in styles and scripts if Outdated Browser is being used
        if ($this->check_show_popup()) {
            add_action('wp_head', array($this, 'osd_outdated_browser_style'));
            add_action('wp_footer', array($this, 'osd_outdated_browser_script'));            
        }
    }


    // Default variables
    public static $defaults = array(
        'browser' => 'none',
        'bg-color' => '#ffffff',
        'font-color' => '#000000',
        'cookie' => 'minutes',
        'message' =>
            "<div style='text-align: center;' class='osd-outdated-browser-title'>Did you know that your browser is out of date?</div>
            <p style='text-align: center;'>Your browser is out of date and may not be able to properly display our website.</p>
            <p style='text-align: center;'>A list of recommended browsers is below; click an icon to go to the browser's download page.</p>
            <p style='text-align: center;' class='osd-outdated-browser-images'>
                <a target='_blank' href='http://google.com/chrome'><img width='48' alt='Google Chrome' src='###URL###/osd-outdated-browser/img/chrome.png' /></a>&nbsp;&nbsp;<a target='_blank' href='http://mozilla.org/firefox'><img width='48' alt='Firefox' src='###URL###/osd-outdated-browser/img/firefox.png' /></a>
            </p>
            <p style='text-align: center;'>
                <span class='osd-outdated-browser-close' id='osd-outdated-browser-close' style='text-decoration: underline; display: inline-block; margin: 5px 0;'>Close this window</span>
            </p>
            <p style='text-align: center;'>By closing this window you acknowledge that your experience on our website may be degraded.</p>
            ");


    // Returns true if the popup should be shown
    private function check_show_popup() {
        if (!is_active_widget(false, false, "osd_outdated_browser_widget", true)) {
            return false;
        } else if (isset($_COOKIE['osd_outdated_browser'])) {
            return false;
        }
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if ($this->get_val('browser') == 'none') {
            return false;
        } else if ($this->get_val('browser') == 'all') {
            return true;
        } else if (preg_match("/Trident\/.*rv:([0-9]{2,2})\.0/", $userAgent, $match) || 
                preg_match("/MSIE\s([0-9]{1,2})\.0/", $userAgent, $match)) {
            if (stripos($userAgent, "opera") !== false) {
                return false;
            } else if ($match[1] <= $this->get_val('browser')) {
                return true;
            }
        }
    }


    // Returns the default value if one is not set
    private function get_val($prop) {
        if ($prop == "message" && !$this->options[$prop]) {
            OSD_Outdated_Browser::$defaults[$prop] = str_replace("###URL###", plugins_url(), OSD_Outdated_Browser::$defaults['message']);
        }
        return ($this->options[$prop]) ? $this->options[$prop] : OSD_Outdated_Browser::$defaults[$prop];
    }


    // Outputs the content of the widget
    public function widget($args, $instance) {
        if ($this->check_show_popup()) {
            $this->output_html($this->options);
        }
    }

    // Outputs the content of the widget
    private function output_html($options) {
        $content = "<div id='osd-outdated-browser' class='osd-outdated-browser'>".apply_filters('the_content', $this->get_val('message'))."</div>";
        echo apply_filters('osd_outdated_browser', $content, $options);
    }


    // Outputs the options form on admin
    public function form($instance) {
        echo "<p>Visit the settings page to customize this widget</p>";
    }


    // Processing widget options on save
    public function update($new_instance, $old_instance) {
        foreach ($new_instance as $key => $value) {
            $new_instance[$key] = strip_tags($new_instance[$key]);
        }
        return $new_instance;
    }


    // Register OSD Outdated Browser Style
    public function osd_outdated_browser_style() {
        $style = file_get_contents('style.css', true);
        $style = str_replace("##BG-COLOR##", $this->get_val('bg-color'), $style);
        $style = str_replace("##FONT-COLOR##", $this->get_val('font-color'), $style);
        echo "<style>\n".$style."\n</style>";
    }


    // Register OSD Outdated Browser Script
    public function osd_outdated_browser_script() {
        $script = file_get_contents('script.js', true);
        $script = str_replace("##COOKIE##", $this->get_val('cookie'), $script);
        echo "<script>\n".$script."\n</script>";
    }
}


// Register OSD Outdated Browser Widget
add_action('widgets_init', function() {
    register_widget('OSD_Outdated_Browser');
});


// Include options
include_once('osd_outdated_browser_options.php');
?>