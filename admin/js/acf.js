/**
 * Add JS to ACF Actions
 *
 * @see https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/
 */
(function( $ ) {
	'use strict';

  var $publish = $('#submitdiv');
  var $subscriber = $('#acf-group_subscriber_content');
  var $coauthors = $('#coauthorsdiv');

  $subscriber.insertAfter( $publish );
  $coauthors.insertAfter( $subscriber );

})( jQuery );
