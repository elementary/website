// jQuery.leanModal2.js v2.2 (edited)
// MIT Licensed by eustasy http://eustasy.org
// Based on leanModal v1.1 by Ray Stone - http://finelysliced.com.au

// Wrap in an anonymous function.
(function($){

	// Function: Fade out the Overlay and a passed identifier
	function leanModal_Close(modal_id) {
		$(modal_id).animate({'opacity': 0}, 200, function() {
			$(modal_id).removeClass('active')
		})
	}

	// Define a new Extension.
	$.fn.extend({
		leanModal: function(options) {

			// FORLINK For each targetted link.
			return this.each(function() {

				$(this).css({ 'cursor': 'pointer' });

				$(this).unbind('click').click(function(e) {

					// IFHREF Fetch the Modal_ID
					if ( $(this).attr('href') ) {
						var modal_id = $(this).attr('href');
					// IFHREF Fall back to if no href data-open-modal.
					} else if ( $(this).attr('data-modal-id') ) {
						var modal_id = $(this).attr('data-modal-id');
					} else {
						return false;
					} // IFHREF

					// Set the function to close the overlay if you outside it.
					$('.modal').click(function(e) {
						if (e.target != this) return

						leanModal_Close(modal_id);
					});

					// If a close button is set, link it to the close command.
					if ( options.closeButton ) {
						$(options.closeButton).click(function() {
							leanModal_Close(modal_id);
						});
					}

					// Close the modal on escape
					$(document).on('keyup', function(evt) {
						if (evt.keyCode == 27) {
							leanModal_Close(modal_id);
						}
					});

					$(modal_id).addClass('active').animate({'opacity': 1}, 200)

					// Prevent whatever the default was (probably scrolling).
					e.preventDefault();

				});
			}); // FORLINK

		}
	});

// Apparently this jQuery is important.
})(jQuery);
