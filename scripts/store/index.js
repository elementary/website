$(function () {
  $('.product img').on('click', function (event) {
    if (event.target != this) return;
    event.preventDefault();

    var $product = ($(this).hasClass('product')) ? $(this) : $(this).closest('.product');
    var product = $product.attr('id');
    var category = $(this).closest('.category').attr('id');
    var uid = category + '-' + product;

    var $modal = $('div.modal#' + uid);
    var $modalButton = $product.find('.open-modal');

    $modalButton.leanModal({
      closeButton: '.close-modal'
    });
    $modalButton.click();
  });
});
