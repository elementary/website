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

        const $slingshotGrid = $('#slingshot-grid')
        const $slingshotCategories = $('#slingshot-categories')
        const $slingshotCategoriesBtn = $('#slingshot-categories-button')
        const $slingshotGridButton = $('#slingshot-grid-button')
        const $slingshotSearch = $('#slingshot-search')
        const $slingshotClearIcon = $('.slingshot .clear-icon')
        const $slingshotSearchTerm = $('.slingshot .search-term')
        const $searchOne = $('.searchone')
        const $searchTwo = $('.searchtwo')
        const $searchThree = $('.searchthree')
        const $slingshotLinked = $('.slingshot .linked')
        const $slingshotEntry = $('.slingshot .entry')
        const $slingshotAreas1 = $('.slingshot .clear-icon, .slingshot .search-term, .slingshot-search-results')
        ;(function animation () {
            setTimeout(() => {
                if ($slingshotGrid.hasClass('active')) {
                    $slingshotGrid.addClass('previous')
                    $slingshotGrid.removeClass('active')
                    $slingshotCategories.removeClass('next')
                    $slingshotCategories.addClass('active')
                    $slingshotCategoriesBtn.addClass('active')
                    $slingshotGridButton.removeClass('active')
                } else if ($slingshotCategories.hasClass('active')) {
                    $slingshotCategories.addClass('previous')
                    $slingshotCategories.removeClass('active')
                    $slingshotSearch.removeClass('next')
                    $slingshotSearch.addClass('active')
                    $slingshotClearIcon.removeClass('inactive')
                    $slingshotSearchTerm.removeClass('inactive')
                    $searchOne.addClass('active')
                    setTimeout(function () {
                        $searchOne.removeClass('active')
                        $searchTwo.addClass('active')
                    }, 700)
                    setTimeout(function () {
                        $searchTwo.removeClass('active')
                        $searchThree.addClass('active')
                    }, 1200)
                    $searchThree.removeClass('active')
                    $slingshotLinked.addClass('inactive')
                    $slingshotEntry.addClass('expanded')
                } else if ($slingshotSearch.hasClass('active')) {
                    $slingshotSearch.addClass('next')
                    $slingshotSearch.removeClass('active')
                    $slingshotGrid.removeClass('previous')
                    $slingshotGrid.addClass('active')
                    $slingshotCategories.addClass('next')
                    $slingshotCategories.removeClass('previous')
                    $slingshotAreas1.addClass('inactive')
                    $slingshotLinked.removeClass('inactive')
                    $slingshotEntry.removeClass('expanded')
                    $slingshotGridButton.addClass('active')
                    $slingshotCategoriesBtn.removeClass('active')
                }
                requestAnimationFrame(animation)
            }, 3000)
        })()
        console.log('Loaded slingshot.js')
    })
})
