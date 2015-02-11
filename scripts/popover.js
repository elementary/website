$(function () {
	$(document).on('click', '.popover > a', function (event) {
		event.preventDefault();

		var $link = $(event.target)
		var $popover = $link.parent();
		var $content = $popover.find('.popover-content');
		$popover.addClass('active');

		var popoverPos = ($link.offset().left - $popover.offset().left) / 2;
		if (popoverPos == 0) {
			popoverPos -= 100 - $link.width() / 2;
		}
		$content.css({ left: popoverPos });

		$(document).one('click', function (event) {
			if (!$(event.target).is('.popover-content *')) {
				event.stopImmediatePropagation();
				event.preventDefault();
			}
			
			$popover.removeClass('active');
		});
	});
});