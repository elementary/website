$('#download').click(function(){
    console.log('Clicked #download');
    $(function(){
        $('.open-modal').leanModal({
            // Top in Pixels as INT.
            // Perhaps set to nonsense and style in CSS.
            top: 'NOTHANKS',
            closeButton: '.close',
            overlayOpacity: 0.70
        });
    });
    $('.open-modal').click();
});
console.log('Loaded homepage.js');
