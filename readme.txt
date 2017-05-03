=== TNI Core Functionality ===
Contributors: misfist
Tags: custom
Requires at least: 4.7
Tested up to: 4.7.4
Version: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Contains the site's core functionality.

== Description ==

Contains the site's core functionality.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `tni-core-functionality.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.1.1 May 2, 2017 =
* #17 Added ability to customize text used for post description
  * Added `seo_description` field
  * Added `jetpack_open_graph_tags` filter to set `og:description` to `seo_description`, if it exists

= 1.1.0 April 27, 2017 =
* Added featured post settings page

= 1.0.14 April 25, 2017 =
* Add author to posts search

= 1.0.13 =
* #10 Remove escapes for caption and margin shortcodes since they can contain HTML tags
* #13 Disable shortcode ui for shortcodes

= 1.0.12 April 18, 2017 =
* Added close button for login modal

= 1.0.10 April 17, 2017 =
* #44 Include blogs in magazine article selection

= 1.0.9 April 12, 2017 =
*  #4 Add subscription integration

= 1.0.8.1 April 14, 2017 =
* #37 About page
    * Added custom user field for "public_title"
    * Added template tag for getting editorial list `tni_core_editors_by_title()`

= 1.0.8 April 11, 2017 =
* Added Co-authors Plus support to Related Posts

= 1.0.7 April 7, 2017 =
* Removed unused featured content option page
* Removed form processor

= 1.0.6 February 18, 2017 =
* Added custom JetPack related posts shortcode
* #9, #10 Added form processor

= 1.0.5.1 February 18, 2017 =
* Applied legacy `[rr]` and `[ll]` shortcode to `right-margin` and `left-margin` mark-up

= 1.0.5 February 18, 2017 =
* Added `right-margin` and `left-margin` shortcode and quicktags
* Applied legacy `[lr]` and `[rl]` shortcode to `right-margin` and `left-margin` mark-up

= 1.0.4 February 14, 2017 =
* Added `show-more` shortcode and functionality

= 1.0.3 February 12, 2017 =
* Added Quicktag for adding  `drop-cap` and `show-more`
* Added `read-more` functionality

= 1.0.2.1 February 2, 2017 =
* Renamed `editors_note` field to `issue_toc`
* Added `issue_gallery` field to add WP gallery

= 1.0.2 =
* Added options page and option field to select current issue
* Added promo image field to Magazine post type
* Added featured post field to Magazine post type

= 1.0.1 =
Bumped version to 1.0.1

= 12/12/2016 =
Added shortcode for form entry count and registered with Shortcode UI

= 1.0.0 =
Initial.
