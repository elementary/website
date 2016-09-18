/**
 * _scripts/slider.js
 * A content container that slides information horizontally
 *
 * @exports {Slider} default - A content container that slides
 */

/**
 * A slider.
 * @param {Object} options Slider options.
 * @param {String} options.slideContainer The slider container selector.
 * @param {String} options.choiceContainer The choices container selector.
 * @param {String[]} options.slides The slider choices selectors.
 * @param {Boolean} options.fixed Update slideContainer height based on slide.
 */
var Slider = function (options) {
    // slider variables
    this.slideContainer = options.slideContainer
    this.choiceContainer = options.choiceContainer
    this.slides = options.slides
    this.fixed = options.fixed

    this.currentIndex = null

    // initial setup
    var that = this

    for (var i = 0; i < this.slides.length; i++) {
        var n = this.slides[i]
        var $iChoice = $("[href$='" + n + "']", this.choiceContainer)

        // each choice button
        $iChoice.on('click', function (e) {
            e.preventDefault()
            that.slideTo($(this).attr('href').split('#').pop()) // slide on click of button
        })
    }

    $(window).resize(function () {
        that.resize()
    })

    // default position, slide to first slide
    this.slideTo(this.slides[0])
}

/**
 * Show a specific slide.
 * @param {String} rSlide The slide id.
 */
Slider.prototype.slideTo = function (rSlide) {
    if (this.slides.indexOf(rSlide) === -1) { // could not find requested slide
        return console.log("ERROR: could not find requested slide '" + rSlide + "'") // log an error
    }

    // iterates through slides based on this.slides
    for (var i = 0; i < this.slides.length; i++) {
        var n = this.slides[i]
        var $n = $('#' + n, this.slideContainer) // current iterated slide

        if (n === rSlide) { // if correct slide
            $n.removeClass('previous next').addClass('active')
            this.currentIndex = i
        } else if ($n.index() < $('#' + rSlide, this.slideContainer).index()) { // if previous slide
            $n.removeClass('active next').addClass('previous')
        } else { // everything else is next
            $n.removeClass('previous active').addClass('next')
        }
    };

    // iterate over choices
    for (var l = 0; l < this.slides.length; l++) {
        var s = this.slides[l]
        var $choice = $("[href$='" + s + "']", this.choiceContainer)
        var href = $choice.attr('href').split('#').pop()

        if (href === this.slides[this.currentIndex]) { // current choice
            $choice.addClass('active')
        } else {
            $choice.removeClass('active')
        }
    }

    this.resize() // resize the container
}

/**
 * Reset height of container
 */
Slider.prototype.resize = function () {
    var height = 0

    if (this.fixed) { // if the container should be a fixed height
        // iterates through slides
        $.each(this.slides, function (i, n) {
            var $iSlide = $('#' + n, this.sliderContainer) // current iterated slide

            if ($iSlide.outerHeight(true) > height) { // new tallest slide
                height = $iSlide.outerHeight(true)
            }
        })

        $(this.slideContainer).outerHeight(height) // set fixed height
    } else { // resize container based on slide
        height = $('#' + this.slides[this.currentIndex], this.sliderContainer).outerHeight(true) // get current slide height

        $(this.slideContainer).outerHeight(height) // set height
    }
}

export default Slider
