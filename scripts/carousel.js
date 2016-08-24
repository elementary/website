$(function () {

    // Showcase
    $(function() {
      var showcase = new Showcase({
        container: '#showcase',
        index: '#showcase-index',
        slides: [
          'showcase-music',
          'showcase-epiphany',
          'showcase-mail',
          'showcase-photos',
          'showcase-videos',
          'showcase-calendar',
          'showcase-files',
          'showcase-terminal',
          'showcase-scratch',
          'showcase-camera'
        ],
        fixed: false
      });

      var terminal = new Terminal();
      terminal.onHold = ($(window).width() <= 1050);

      $('#showcase .showcase-tab .showcase-back').on('click', function(e) {
        e.preventDefault();
        showcase.slideTo('index');
      });

      $('#showcase').on('change', function(e, d) {
        if (d != null && d.active === 'showcase-terminal') {
          terminal.$w.addClass('active');
        } else {
          terminal.$w.removeClass('active');
        }
      });

      $(window).on('resize', function() {
        if ($(window).width() <= 1050) {
          if (!terminal.onHold) {
            terminal.onHold = true
          }
        } else {
          if (terminal.onHold) {
            terminal.onHold = false
          }
        }
      })
    });

    $(function() {
        $.getJSON('data/slingshot.json', function(data) {
            $.each(data.grid, function(i, f) {
                var griditems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(griditems).appendTo(".slingshot-grid");
            });
            $.each(data.categories, function(i, f) {
                var categoriesitems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(categoriesitems).appendTo(".slingshot-categories");
            });
            $.each(data.searchone, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchone");
            });
            $.each(data.searchtwo, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchtwo");
            });
            $.each(data.searchthree, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchthree");
            });
        });
    });

    $(function() {
        window.setInterval(function() {
            if( $('#slingshot-grid').hasClass('active') ){
                $('#slingshot-grid').addClass('previous');
                $('#slingshot-grid').removeClass('active');
                $('#slingshot-categories').removeClass('next');
                $('#slingshot-categories').addClass('active');
                $('#slingshot-categories-button').addClass ('active');
                $('#slingshot-grid-button').removeClass ('active');
            } else if( $('#slingshot-categories').hasClass('active') ){
                $('#slingshot-categories').addClass('previous');
                $('#slingshot-categories').removeClass('active');
                $('#slingshot-search').removeClass('next');
                $('#slingshot-search').addClass('active');
                $('.slingshot .clear-icon').removeClass ('inactive');
                $('.slingshot .search-term').removeClass ('inactive');
                $('.searchone').removeClass ('inactive');
                setTimeout(function(){
                    $('.slingshot-search-results').addClass ('inactive');
                    $('.searchtwo').removeClass ('inactive');
                }, 700);
                setTimeout(function(){
                    $('.slingshot-search-results').addClass ('inactive');
                    $('.searchthree').removeClass ('inactive');
                }, 1200);
                $('.slingshot .linked').addClass ('inactive');
                $('.slingshot .entry').addClass ('expanded');
            } else if( $('#slingshot-search').hasClass('active') ){
                $('#slingshot-search').addClass('next');
                $('#slingshot-search').removeClass('active');
                $('#slingshot-grid').removeClass('previous');
                $('#slingshot-grid').addClass('active');
                $('#slingshot-categories').addClass('next');
                $('#slingshot-categories').removeClass('previous');
                $('.slingshot .clear-icon, .slingshot .search-term, .slingshot-search-results').addClass ('inactive');
                $('.slingshot .linked').removeClass ('inactive');
                $('.slingshot .entry').removeClass ('expanded');
                $('#slingshot-grid-button').addClass ('active');
                $('#slingshot-categories-button').removeClass ('active');
            }
        }, 3000);
    });

    // Change Button text on payment click
    function updateDownloadButton () {
        var translate_download = $('#translate-download').text();
        var translate_purchase = $('#translate-purchase').text();

        if ($('#amounts').children().length <= 1) {
            $('#download').text(translate_download);
            document.title = translate_download;
        } else if (
            $('button.payment-button').hasClass('checked') ||
            $('#amount-custom').val() * 100 >= payment_minimum
        ) {
            $('#download').text(translate_purchase);
            document.title = translate_purchase;
        } else {
            $('#download').text(translate_download);
            document.title = translate_download;
        }
    }

    $('#amounts').on('click', updateDownloadButton);
    $('#amounts input').on('input', updateDownloadButton);
    updateDownloadButton();

    console.log('Loaded carousel.js');
});
