<?php
/**
 * Options for osd_outdated_browser
 * ----------------------------------------------------------------------------
 */

if (is_admin()) {
    add_action('admin_menu', 'osd_outdated_browser_options');
    add_action('admin_init', 'osd_outdated_browser_register_options');
}

// Add submenu of options
function osd_outdated_browser_options() {
    add_submenu_page('options-general.php', 'OSD Outdated Browser', 'OSD Outdated Browser', 'manage_options', 'osd-outdated-browser-options', 'osd_outdated_browser_options_callback'); 
}


// Output options HTML
function osd_outdated_browser_options_callback() {
    ?>
    <style>
        #pre-div, #post-div { float: left; width: 50%; }
        .cont:after { content: ""; display: block; clear: both; }
        label { font-weight: 700; font-size: 1.1em; }
        li { padding-top: 20px; }
        .desc { margin-bottom: .5em; font-style: italic; }
    </style>
    <h2>OSD Outdated Browser</h2>
    <p>Display a banner on outdated browsers informing users to update their browsers.</p>
    <form action="options.php" method="post">
        <?php 
            settings_fields('osd_outdated_browser_options');
            do_settings_sections('osd_outdated_browser_options');
            $options = get_option('osd_outdated_browser_options');
            $options['message'] = get_option('osd_outdated_browser_message');
            global $osd_outdated_browser_instance;

            foreach ($osd_outdated_browser_instance->defaults as $key => $value) {
                if ($key == "message") {
                    $value = str_replace("###URL###", plugins_url(), $osd_outdated_browser_instance->defaults['message']);
                }
                $options[$key] = ($options[$key]) ? $options[$key] : $value;
            }
        ?>
        <ul>
            <li>
                <label for='osd_outdated_browser_options[browser]'>Browser Version Threshold:</label><br>
                <div class='desc'>All versions equal to and below this value will display a banner</div>
                <select name='osd_outdated_browser_options[browser]' value='<?php echo $options['browser']; ?>'>
                    <option <?php selected($options['browser'], 'none'); ?> value=''>None</option>
                    <option <?php selected($options['browser'], 'all'); ?> value='all'>All</option>
                    <option <?php selected($options['browser'], '11'); ?> value='11'>IE 11</option>
                    <option <?php selected($options['browser'], '10'); ?> value='10'>IE 10</option>
                    <option <?php selected($options['browser'], '9'); ?> value='9'>IE 9</option>
                    <option <?php selected($options['browser'], '8'); ?> value='8'>IE 8</option>
                    <option <?php selected($options['browser'], '7'); ?> value='7'>IE 7</option>
                    <option <?php selected($options['browser'], '6'); ?> value='6'>IE 6</option>
                </select>
            </li>
            <li>
                <label for='osd_outdated_browser_options[cookie]'>Cookie duration:</label><br>
                <div class='desc'>This sets the length of time the cookie lasts when a user closes the outdated browser banner</div>
                <select name='osd_outdated_browser_options[cookie]' value='<?php echo $options['cookie']; ?>'>
                    <option <?php selected($options['cookie'], 'no-cookie'); ?> value='no-cookie'>Don't set a cookie</option>
                    <option <?php selected($options['cookie'], 'session'); ?> value='session'>Session</option>
                    <option <?php selected($options['cookie'], 'minutes'); ?> value='minutes'>30 Minutes</option>
                    <option <?php selected($options['cookie'], 'hour'); ?> value='hour'>1 Hour</option>
                    <option <?php selected($options['cookie'], 'day'); ?> value='day'>1 Day</option>
                    <option <?php selected($options['cookie'], 'month'); ?> value='month'>1 Month</option>
                    <option <?php selected($options['cookie'], 'year'); ?> value='year'>1 Year</option>
                </select>
            </li>
            <li>
                <label for="osd_outdated_browser_options[bg-color]">Background Color:</label>
                <div class="desc">Background color of the banner</div>
                <input type="text" id='bg-color' name='osd_outdated_browser_options[bg-color]' value='<?php echo $options['bg-color']; ?>' />
            </li>
            <li>
                <label for="osd_outdated_browser_options[font-color]">Font Color:</label>
                <div class="desc">Font color of the banner</div>
                <input type="text" id='font-color' name='osd_outdated_browser_options[font-color]' value='<?php echo $options['font-color']; ?>' />
            </li>
            <li>
                <label for='osd_outdated_browser_option_message'>Message:</label>
                <div class="desc">Message that displays in the banner</div>
                <?php wp_editor(apply_filters('content_edit_pre', $options['message']), 'content', array('textarea_name'=>'osd_outdated_browser_message')); ?>
            </li>
        </ul>
        <?php submit_button(); ?>
        <script>
            jQuery(document).ready(function () {
                jQuery('#bg-color').wpColorPicker();
                jQuery('#font-color').wpColorPicker();
            });
        </script>
    </form>
    <?php
}


// Applies the filter for content_edit_pre before the field is saved
function apply_content_edit_filter($content) {
    return apply_filters('content_save_pre', $content);
}


// Register the options with WP
function osd_outdated_browser_register_options() {
    register_setting('osd_outdated_browser_options', 'osd_outdated_browser_options');
    register_setting('osd_outdated_browser_options', 'osd_outdated_browser_message', 'apply_content_edit_filter');
}
?>