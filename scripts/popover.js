$(function () {
	$(document).on('click', '.popover > a', function (event) {
		event.preventDefault();

		var $popover = $(event.target).parent();
		$popover.addClass('active');

		$(document).one('click', function (event) {
			$popover.removeClass('active');
			event.stopImmediatePropagation();
		});
	});
});