=== TNI Core Functionality ===
Contributors: misfist
Tags: custom
Requires at least: 4.7
Tested up to: 4.8
Version: 1.2.11
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

= 1.2.11 October 3, 2017 =
* #92 Added `audio_url` field to blogs post type. @link https://github.com/thenewinquiry/tni-theme/issues/92

= 1.2.10 Sept 15, 2017 =
* Reduced unauthorized post transient cache time
* Enabled unauthorized post transient clearing on post publish

= 1.2.9 Aug 18, 2017 =
* Added function return array of unauthorized post IDs

= 1.2.8 July 6, 2017 =
* #33 Fixed PHP error caused when `TNI_Core_Authorization` class is instantiated without passing required values `$file` and `$version`
* #77 & #78 Added new functionality for subscriber-only content - In single.php template, add conditionals `tni_is_subscription_only` and `tni_core_check_auth` to serve alternate content to non-subscribers
  * Added `subscriber_only_date` date field
  * Moved new Subscriber Only Content metabox below publish box on edit screen
  * Added `tni_is_subscription_only` that returns true or false if content is subscription-only today
  * Removed `show_future_posts` function since subscription date will be used instead

= 1.2.7 June 22, 2017 =
* #29 Added `audio_url` custom field.
  * To access value: `get_post_meta( $post->ID, 'audio_url', true );`

= 1.2.6 June 21, 2017 =
* Show scheduled (future) single posts to authenticated users

= 1.2.5 May 22, 2017 =
* #20 Added utility function to switch post_type `tni_switch_post_type()`

= 1.2.4 May 18, 2017 =
* #66 {https://github.com/thenewinquiry/tni-theme/issues/66} - Fix permalink for `future` posts

= 1.2.3 May 10, 2017 =
* #23 - Added hide featured image checkbox field to blogs.

= 1.2.2 May 10, 2017 =
* #23 - Added hide featured image checkbox field to posts.

= 1.2.1 May 10, 2017 =
* #21 - Fixed JS issue

= 1.2.0 May 9, 2017 =
* #21 - Display contributor list
  * Added selectable `guest_author` roles
  * Added utilities to set up roles
  * Added template tag `tni_core_coauthors_wp_list_authors( $args = array() )` and shortcode `[guest-author-list]`

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
