=== Plugin Name ===
Contributors: osdwebdev
Tags: outdated, old, browser
Requires at least: 3.4
Tested up to: 3.9
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

OSD Outdated Browser plugin allows you to display a custom banner for users using old browsers.

== Description ==

OSD Outdated Browser plugin allows you to display a custom banner for users using old browsers.  The banner is fully customizable and also exposes filters for developers to use.

== Installation ==

1. Upload the osd-outdated-browser directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the settings page under Settings > OSD Outdated Browser
4. If the default message is not used, be sure to include an element with the id "osd-outdated-browser-close" in order to close the banner and set a cookie based on user preferences.
5. Styles can be easily overridden in the theme's style sheet (style.css) or in the WYSIWYG editor
6. If you desire more control over how the banner is displayed, a WordPress filter is available. just use the following code: add_filter('osd-outdated-browser', function($content, $args) {}, 10, 2);
7. Additionally, the WordPress filters content_edit_pre and content_save_pre are applied to the banner content.

== Frequently Asked Questions ==

= Soon to come? =

Yes, as users ask us questions.

== Screenshots ==

1. The default banner of OSD Outdated Browser
2. A slightly themed banner
3. Admin Settings Screen

== Changelog ==

= 1.1 =
* Fixed a logic bug where javascripts and styles were being inserted regardless of the banner showing or not.

= 1.0 =
* Initial creation of the OSD Outdated Browser

== Upgrade Notice ==

= 1.0 =
Display a banner in outdated browsers notifying user to update

== A Brief Feature List ==

1. Fully customizable
2. Filterable banner message using add_filter() for theme developers
3. Easy to style
4. Minimal Code
5. No added load on your installation

Link to plugin page [Wordpress plugin page](http://wordpress.org/plugins/osd-outdated-browser/ "Link").

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"