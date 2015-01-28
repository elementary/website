$(function () {
	$('body').on('click', 'a', function (event) {
		// Event already handled?
		if (event.isDefaultPrevented()) {
			return;
		}

		// Get link href
		var $anchor = $(this);
		var href = $anchor.attr('href');
		if (href[0] !== '#') {
			return;
		}

		// Get offset
		var scrollTop;
		if (href === '#') {
			scrollTop = 0;
		} else {
			scrollTop = $(href).offset().top;
		}

		// Smooth scrolling
		$('html, body').stop().animate({
			scrollTop: scrollTop
		}, 'normal', function () {
			window.location.hash = href;
		});

		event.preventDefault();
	});
});