jQuery( document ).ready( function( $ ) {
	$( '.brittany-light-sample-content-notice' ).on( 'click', '.notice-dismiss', function( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'brittany_light_dismiss_sample_content',
				nonce: brittany_light_SampleContent.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function( response ) {
				//console.log( response );
			}
		} );
	});
} );
