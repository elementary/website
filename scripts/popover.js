$(function () {
	$(document).on('click', '.popover > a', function (event) {
		event.preventDefault();

		var $popover = $(event.target).parent();
		$popover.addClass('active');

		$('body').one('click', function () {
			$popover.removeClass('active');
		});
	});
});