$('.js-target-jquery-leanmodal-overlay').on('scroll touchmove mousewheel', function (e) {
    e.preventDefault();
    e.stopPropagation();
    return false;
});

$('#download').click(function(){
    console.log('Clicked #download');
    $(function(){
        $('.open-modal').leanModal();
    });
    $('.open-modal').click();
});
console.log('Loaded homepage.js');
