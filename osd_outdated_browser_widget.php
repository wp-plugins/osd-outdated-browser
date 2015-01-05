<?php
/**
 * Widget class for notifying users that they are using an outdated browser
 * ----------------------------------------------------------------------------
 */

class OSD_Outdated_Browser_Widget extends WP_Widget {
    // Widget Constructor
    public function __construct() {
        parent::__construct(
            'osd_outdated_browser_widget',
            'OSD Outdated Browser',
            array('description' => __('Add a banner for outdated browsers.'))
        );
    }


    // Outputs the content of the widget
    public function widget($args, $instance) {
        global $osd_outdated_browser_instance;
        $osd_outdated_browser_instance->output_html();
    }


    // Outputs the options form on admin
    public function form($instance) {
        echo "<p>Visit the settings page to customize this widget</p>";
    }
}


// Register OSD Outdated Browser Widget
function register_osd_outdated_browser_widget() {
    register_widget('OSD_Outdated_Browser_Widget');
}
add_action('widgets_init', 'register_osd_outdated_browser_widget');