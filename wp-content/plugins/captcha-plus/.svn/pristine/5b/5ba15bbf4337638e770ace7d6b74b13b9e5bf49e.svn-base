(function($) {
	$(document).ready( function() {
		/*  add to whitelist my ip */
		$( 'input[name="cptchpls_add_to_whitelist_my_ip"]' ).change( function() {
			if ( $( this ).is( ':checked' ) ) {
				var my_ip = $( 'input[name="cptchpls_add_to_whitelist_my_ip_value"]' ).val();
				$( 'input[name="cptchpls_add_to_whitelist"]' ).val( my_ip ).attr( 'readonly', 'readonly' );
			} else {
				$( 'input[name="cptchpls_add_to_whitelist"]' ).val( '' ).removeAttr( 'readonly' );
			}
		});

		var limit_options = $( '.cptchpls_limt_options' );
		$( 'input[name="cptchpls_use_time_limit"]' ).each( function() {
			if ( ! $( this ).is( ':checked' ) )
				limit_options.hide();
		}).click( function() {
			if ( $( this ).is( ':checked' ) )
				limit_options.show();
			else
				limit_options.hide();
		});

		$( '#cptchpls_use_la_whitelist' ).click( function() {
			$( this ).closest( 'form' ).submit();
		});

		/**
		 * @since 1.1.4
		 */
		$( 'button[name="cptchpls_show_whitelist_form"]' ).click( function() {
			$( this ).parent( 'form' ).hide();
			$( '.cptchpls_whitelist_form' ).show();
			return false;
		});
		var package_list = $( "#cptchpls_package_list" );
		if ( package_list.length ) {
			package_list.resizable({ handles: ( $( 'body' ).hasClass( 'rtl' ) ? 'sw' : 'se' ) }).
				find( '.ui-resizable-handle' ).addClass( 'dashicons dashicons-editor-code' );
		}
	});
})(jQuery);