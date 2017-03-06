(function( $ ) {
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	  clearTimeout (timer);
	  timer = setTimeout(callback, ms);
	 };
	})();
	$(document).on( 'input', '#search_courses', function( event ) {
		$('.spinner').fadeIn();
		delay(function(){
			setTimeout(function(){$('.spinner').fadeOut();}, 5000);
			query = $('#search_courses').val();
			$.ajax({
				url: MyAutocomplete.url,
				type: 'get',
				data: {
					action: 'my_search',
					query : query
				},
				dataType: 'json',
				success: function( html ) {
					if (query) {
						$('.autocomplete').html(" ");
						for(var i = 0; i < html.length; i++) {
							var obj = html[i];
							$('.spinner').fadeOut();
							$('.autocomplete').append(
								'<div class="autocomplete-item">' + 
								'<div class="auto-complete-image"><img src="' + obj.image + '"></div>' + 
								'<a href="' + obj.link + '" class="auto-complete-link">' + obj.course_code + '<br />' + obj.label + '</a>' +
									'<div class="auto-complete-quickfacts">' +
										'<div class="quickfacts">' +
											'<div class="quickfacts-icon study_online' + obj.study_online + '" data-toggle="tooltip" title="Wifi Access: YES"></div>' +
										'</div>' +
										'<div class="quickfacts">' +
											'<div class="quickfacts-icon payment_options' + obj.payment_options + '"></div>' +
										'</div>' +
										'<div class="quickfacts">' +
											'<div class="quickfacts-icon nationally_recognized' + obj.nationally_recognized + '"></div>' +
										'</div>' +
										'<div class="quickfacts">' +
											'<div class="quickfacts-icon start_dates' + obj.start_dates + '"></div>' +
										'</div>' +
										'<div class="quickfacts">' +
											'<div class="quickfacts-icon funding_available' + obj.funding_available + '"></div>' +
										'</div>' +
									'</div>'+
								'</div>'

							);
						}
					}
					else{
						$('.autocomplete').html(" ");
						$('.spinner').fadeOut();
						
						
					}
						
				}
			});
		}, 500 );
	});
})( jQuery );

$(document).ready(function(){
 if (sessionStorage.getItem('advertOnce') !== 'true') {
	$('.popup-message').show();
	sessionStorage.setItem('advertOnce','true');
 } 
 $('.close-popup').on('click', function(){
  $('.popup-message').slideUp();
 });
});