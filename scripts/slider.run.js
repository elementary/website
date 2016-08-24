/* global Slider */

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
