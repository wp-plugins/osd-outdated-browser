<?php
/**
 * Plugin Name: OSD Outdated Browser
 * Plugin URI: http://outsidesource.com
 * Description: Notifies users that they are using an outdated browser.
 * Version: 1.5
 * Author: OSD Web Development Team
 * Author URI: http://outsidesource.com
 * License: GPL2v2
 */


// Core OSD Outdated Browser class
class OSD_Outdated_Browser {
    // Constructor
    function __construct() {
        // Set options
        $this->options = get_option('osd_outdated_browser_options');
        $this->options['message'] = get_option('osd_outdated_browser_message');
        
        // Only load in styles and scripts if Outdated Browser is being used
        if ($this->check_show_popup()) {
            add_action('wp_head', array($this, 'osd_outdated_browser_style'));
            add_action('wp_footer', array($this, 'osd_outdated_browser_script'));
        }

        // Add shortcode
        add_shortcode("osd_outdated_browser", array($this, "output_html"));
    }

    // Default variables
    public $defaults = array(
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
            <p style='text-align: center;'>By closing this window you acknowledge that your experience on our website may be degraded.</p>");


    // Returns true if the popup should be shown
    function check_show_popup() {
        if (isset($_COOKIE['osd_outdated_browser'])) {
            return false;
        } else if ($this->get_val('browser') == 'none') {
            return false;
        } else if ($this->get_val('browser') == 'all') {
            return true;
        } else if (preg_match("/Trident\/.*rv:([0-9]{2,2})\.0/", $_SERVER['HTTP_USER_AGENT'], $match) || 
                preg_match("/MSIE\s([0-9]{1,2})\.0/", $_SERVER['HTTP_USER_AGENT'], $match)) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], "opera") !== false) {
                return false;
            } else if ($match[1] <= $this->get_val('browser')) {
                return true;
            }
        }
    }


    // Returns the default value if one is not set
    function get_val($prop) {
        if ($prop == "message" && !$this->options[$prop]) {
            $this->defaults[$prop] = str_replace("###URL###", plugins_url(), $this->defaults['message']);
        }
        return ($this->options[$prop]) ? $this->options[$prop] : $this->defaults[$prop];
    }


    // Show the popup
    function output_html() {
        if ($this->check_show_popup()) {
            $content = "<div id='osd-outdated-browser' class='osd-outdated-browser'>".apply_filters('the_content', $this->get_val('message'))."</div>";
            echo apply_filters('osd_outdated_browser', $content, $this->options);
        }
    }


    // Register OSD Outdated Browser Style
    function osd_outdated_browser_style() {
        $style = file_get_contents('style.css', true);
        $style = str_replace("##BG-COLOR##", $this->get_val('bg-color'), $style);
        $style = str_replace("##FONT-COLOR##", $this->get_val('font-color'), $style);
        echo "<style>\n".$style."\n</style>";
    }


    // Register OSD Outdated Browser Script
    function osd_outdated_browser_script() {
        $script = file_get_contents('script.js', true);
        $script = str_replace("##COOKIE##", $this->get_val('cookie'), $script);
        echo "<script>\n".$script."\n</script>";
    }
}

// Instantiate the instance
$osd_outdated_browser_instance = new OSD_Outdated_Browser();

// Include widget
include_once('osd_outdated_browser_widget.php');

// Include options
include_once('osd_outdated_browser_options.php');