jQuery( document ).ready( function ( $ ) {

	/* Options */
	var tni_chosen_options = {
		disable_search_threshold: 13,
		search_contains: true
	};

	/* Targets */
	var tni_chosen_targets =
		'.appearance_page_tni_front_page select';

	/* Attach */
	$( tni_chosen_targets ).chosen( tni_chosen_options );

} );

/**
 * Add JS to ACF Actions
 *
 * @see https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/
 */

 jQuery( document ).ready( function ( $ ) {

	 if( 'undefined' !== acf ) {

 		/* Guest Author Edit Screen */
 		// Move edit screen elements
 		acf.add_action('ready', function( $el ) {

 			var $publish = $('#coauthors-manage-guest-author-save');
 			var $role = $('#acf-group_guest_author');

 			$role.insertAfter( $publish );

 		});

 	}

 } );
