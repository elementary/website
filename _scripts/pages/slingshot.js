/**
 * _scripts/pages/slingshot.js
 * Populates the homepage slingshot with data, and animates it for demo
 */

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        $.getJSON('data/slingshot.json', function (data) {
            $.each(data.grid, function (i, f) {
                var griditems = '<div class="app ' + f.position + '"><img src="images/' + f.icon + '.svg" alt="' + f.title + '"/><p>' + f.title + '</p>'
                $(griditems).appendTo('.slingshot-grid')
            })
            $.each(data.categories, function (i, f) {
                var categoriesitems = '<div class="app ' + f.position + '"><img src="images/' + f.icon + '.svg" alt="' + f.title + '"/><p>' + f.title + '</p>'
                $(categoriesitems).appendTo('.slingshot-categories')
            })
            $.each(data.searchone, function (i, f) {
                var searchItems = '<span class="results-title">' + f.title + '</span><div class="slingshot-search-results">'
                $.each(f.items, function (i, f) {
                    searchItems += '<div class="search-result"><img class="result-img" src="images/' + f.icon + '.svg" alt="' + f.title + '"/><p>' + f.title + '</p></div>'
                })
                searchItems += '</div>'
                $(searchItems).appendTo('.searchone')
            })
            $.each(data.searchtwo, function (i, f) {
                var searchItems = '<span class="results-title">' + f.title + '</span><div class="slingshot-search-results">'
                $.each(f.items, function (i, f) {
                    searchItems += '<div class="search-result"><img class="result-img" src="images/' + f.icon + '.svg" alt="' + f.title + '"/><p>' + f.title + '</p></div>'
                })
                searchItems += '</div>'
                $(searchItems).appendTo('.searchtwo')
            })
            $.each(data.searchthree, function (i, f) {
                var searchItems = '<span class="results-title">' + f.title + '</span><div class="slingshot-search-results">'
                $.each(f.items, function (i, f) {
                    searchItems += '<div class="search-result"><img class="result-img" src="images/' + f.icon + '.svg" alt="' + f.title + '"/><p>' + f.title + '</p></div>'
                })
                searchItems += '</div>'
                $(searchItems).appendTo('.searchthree')
            })
        })

        window.setInterval(function () {
            if ($('#slingshot-grid').hasClass('active')) {
                $('#slingshot-grid').addClass('previous')
                $('#slingshot-grid').removeClass('active')
                $('#slingshot-categories').removeClass('next')
                $('#slingshot-categories').addClass('active')
                $('#slingshot-categories-button').addClass('active')
                $('#slingshot-grid-button').removeClass('active')
            } else if ($('#slingshot-categories').hasClass('active')) {
                $('#slingshot-categories').addClass('previous')
                $('#slingshot-categories').removeClass('active')
                $('#slingshot-search').removeClass('next')
                $('#slingshot-search').addClass('active')
                $('.slingshot .clear-icon').removeClass('inactive')
                $('.slingshot .search-term').removeClass('inactive')
                $('.searchone').addClass('active')
                setTimeout(function () {
                    $('.searchone').removeClass('active')
                    $('.searchtwo').addClass('active')
                }, 700)
                setTimeout(function () {
                    $('.searchtwo').removeClass('active')
                    $('.searchthree').addClass('active')
                }, 1200)
                $('.searchthree').removeClass('active')
                $('.slingshot .linked').addClass('inactive')
                $('.slingshot .entry').addClass('expanded')
            } else if ($('#slingshot-search').hasClass('active')) {
                $('#slingshot-search').addClass('next')
                $('#slingshot-search').removeClass('active')
                $('#slingshot-grid').removeClass('previous')
                $('#slingshot-grid').addClass('active')
                $('#slingshot-categories').addClass('next')
                $('#slingshot-categories').removeClass('previous')
                $('.slingshot .clear-icon, .slingshot .search-term, .slingshot-search-results').addClass('inactive')
                $('.slingshot .linked').removeClass('inactive')
                $('.slingshot .entry').removeClass('expanded')
                $('#slingshot-grid-button').addClass('active')
                $('#slingshot-categories-button').removeClass('active')
            }
        }, 3000)

        console.log('Loaded slingshot.js')
    })
})
