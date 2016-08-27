
/**
 * _scripts/slider.run.js
 * Creates a content slider for the homepage carousel
 */

import jQuery from 'lib/jquery'

import Slider from './slider'

jQuery.then(($) => {
    $(function () {
        // Carousel
        // TODO: fix slider actions on load
        // eslint-disable-next-line no-new
        new Slider({
            slideContainer: '.slide-container',
            choiceContainer: '#carousel-choices',
            slides: ['photos', 'music', 'videos', 'midori'],
            fixed: true
        })

        console.log('Loaded slider.run.js')
    })
})
