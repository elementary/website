// jQuery.leanModal2.js
// MIT Licensed by eustasy http://eustasy.org
// Based on leanModal v1.1 by Ray Stone - http://finelysliced.com.au

// Wrap in an anonymous function.
(function($){

    // Function: Fade out the Overlay and a passed identifier
    function leanModal_Close(modal_id) {
        $('.js-target-jquery-leanmodal-overlay').fadeOut(300);
        $(modal_id).fadeOut(200);

        $('body').css({ 'overflow': 'visible' });
    }

    // Define a new Extension.
    $.fn.extend({
        leanModal: function(options) {

            // Set some Defaults.
            var defaults = {
                overlayOpacity: 0.6,
                closeButton: false
            };

            // Merge in the passed options.
            options = $.extend(defaults, options);

            // If there isn't an overlay, add one.
            if ( $('.js-target-jquery-leanmodal-overlay').length == 0 ) {
                var overlay = $('<div class="js-target-jquery-leanmodal-overlay"></div>');
                $('body').append(overlay);
            }

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

                    // Set the function to close the overlay if you click it.
                    $('.js-target-jquery-leanmodal-overlay').click(function() {
                        leanModal_Close(modal_id);
                    });

                    // If a close button is set, link it to the close command.
                    if ( options.closeButton ) {
                        $(options.closeButton).click(function() {
                            leanModal_Close(modal_id);
                        });
                    }

                    var modal_height = $(modal_id).height();
                    var modal_width = $(modal_id).width();
                    $(modal_id).height(modal_height);
                    $(modal_id).width(modal_width);
                    $(modal_id).addClass('modal-position');

                    $('.js-target-jquery-leanmodal-overlay').css({ 'display': 'block', opacity: 0 });
                    $('.js-target-jquery-leanmodal-overlay').fadeTo(300, options.overlayOpacity);
                    $(modal_id).fadeTo(200, 1);

                    $('body').css({ 'overflow': 'hidden' });

                    // Prevent whatever the default was (probably scrolling).
                    e.preventDefault();

                    $(modal_id + ', .js-target-jquery-leanmodal-overlay').on('scroll touchmove mousewheel', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });

                });
            }); // FORLINK

        }
    });

// Apparently this jQuery is important.
})(jQuery);
