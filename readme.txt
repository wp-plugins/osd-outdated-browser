=== Plugin Name ===
Contributors: osdwebdev
Tags: outdated, old, browser
Requires at least: 3.4
Tested up to: 4.0
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

OSD Outdated Browser widget allows you to display a custom banner for users using old browsers.

== Description ==

OSD Outdated Browser widget allows you to display a custom banner for users using old browsers.
The banner is fully customizable and also exposes filters for developers to use. All a user needs to do
is install/activate the plugin, set up the proper settings, then add the OSD Outdated Browser widget 
to a widget area.

== Installation ==

1. Upload the osd-outdated-browser directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the settings page under Settings > OSD Outdated Browser
4. Add the OSD Outdated Browser widget to any widget area in your theme.
5. If the default message is not used, be sure to include an element with the id "osd-outdated-browser-close" in order to close the banner and set a cookie based on user preferences.
6. Styles can be easily overridden in the theme's style sheet (style.css) or in the WYSIWYG editor
7. If you desire more control over how the banner is displayed, a WordPress filter is available. just use the following code: add_filter('osd-outdated-browser', function($content, $args) {}, 10, 2);
8. Additionally, the WordPress filters content_edit_pre and content_save_pre are applied to the banner content.

== Frequently Asked Questions ==

= Soon to come? =

Yes, as users ask us questions.

== Screenshots ==

1. The default banner of OSD Outdated Browser
2. A slightly themed banner
3. Admin Settings Screen

== Changelog ==

= 1.3 =
* Fixed a bug where older versions of PHP would not work.
* Fixed a minor style issue
* Updated instructions because they were terrible and mentioned nothing of being a widget

= 1.2 =
* Fixed a style bug in IE.

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