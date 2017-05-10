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
