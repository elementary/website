$('#download').click(function(){
    console.log('Clicked #download');
    $(function(){
        $('.open-modal').leanModal();
    });
    $('.open-modal').click();
});
console.log('Loaded homepage.js');
