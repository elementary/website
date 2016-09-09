/**
 * _scripts/widgets/showcase.js
 * A showcase slider for the elementary homepage
 *
 * @exports {Class} default - A showcase slider for the elementary homepage
 */

/**
 * default
 * A showcase slider for elementary homepage.
 *
 * @param {Object} options - Showcase options.
 * @param {String} options.container - The slider container.
 * @param {String} options.index - The container holding all the choices.
 * @param {String[]} options.slides - The slider choices selectors.
 * @param {Boolean} options.fixed - Update container height based on slide.
 */
export default class Showcase {

    /**
     * constructor
     * Creates a new Showcase
     *
     * @param {Object} options - Showcase options
     * @param {String} options.container - Showcase container selector
     * @param {String} options.index - Showcase index page selector
     * @param {String} slides[] - Selectors for each page of Showcase
     * @param {Booleam} fixed - true if Showcase should not change size
     */
    constructor (options) {
        this.container = options.container || '#showcase'
        this.index = options.index || '#showcase-index'
        this.slides = options.slides || []
        this.fixed = options.fixed || false

        this.current = null
    }

    /**
     * start
     * Starts javascript logic for showcase
     * NOTE: must be ran before any other functions so jQuery is loaded!
     */
    start () {
        for (var i = 0; i < this.slides.length; i++) {
            var n = this.slides[i]
            var $iChoice = $("[href$='" + n + "']", this.container)
            var $iContainer = $('#' + n, this.container)

            $iContainer.prepend('<div class="showcase-back"></div>')

            // each choice button
            const that = this
            $iChoice.on('click', function (e) {
                e.preventDefault()
                that.slideTo($(this).attr('href').split('#').pop()) // slide on click of button
            })
        }

        $(window).resize(() => this.resize())

        $(this.container).addClass('initialized')
        this.slideTo('index')

        // Listen for some cool mobile touch gestures
        var touchStartX = null
        var touchStartY = null

        $(document).on('touchstart', this.container, (e) => {
            touchStartX = e.touches[0].pageX
            touchStartY = e.touches[0].pageY
        })

        $(document).on('touchend', (e) => {
            var touchEndX = e.changedTouches[e.changedTouches.length - 1].pageX
            var touchEndY = e.changedTouches[e.changedTouches.length - 1].pageY

            var movementX = touchEndX - touchStartX
            var movementY = touchEndY - touchStartY

            if (Math.abs(movementY) < (movementX / 3) && movementX > 100) {
                this.slideTo('index')
            }

            touchStartX = null
            touchStartY = null
        })
    }

    /**
     * slideTo
     * Slides to a specific slide
     *
     * @param {String} rSlide - the ID of the requested slide
     */
    slideTo (rSlide) {
        if (rSlide !== 'index' && this.slides.indexOf(rSlide) === -1) { // could not find requested slide
            return console.error("could not find requested slide '" + rSlide + "'") // log an error
        }

        if (rSlide === 'index') {
            $(this.index, this.container).addClass('active')
        } else {
            $(this.index, this.container).removeClass('active')
        }

        // iterates through slides based on this.slides
        for (var i = 0; i < this.slides.length; i++) {
            var n = this.slides[i]
            var $n = $('#' + n, this.container) // current iterated slide

            if (n === rSlide) { // if correct slide
                $n.addClass('active')
            } else {
                $n.removeClass('active')
            }
        }

        this.current = rSlide
        $(this.container).trigger('change', {
            active: rSlide
        })

        if (this.current !== 'index') {
            $('body').animate({
                scrollTop: $(this.container).offset().top
            }, 100)
        }

        this.resize() // resize the container
    }

    /**
     * resize
     * Reset height of container
     */
    resize () {
        var height = 0

        if (this.fixed) { // if the container should be a fixed height
            height = $(this.index, this.container).outerHeight(true)

            // iterates through slides
            $.each(this.slides, function (i, n) {
                var $iSlide = $('#' + n, this.container) // current iterated slide

                if ($iSlide.outerHeight(true) > height) { // new tallest slide
                    height = $iSlide.outerHeight(true)
                }
            })

            $(this.container).height(height) // set fixed height
        } else { // resize container based on slide
            if (this.current === 'index') {
                height = $(this.index, this.container).outerHeight(true)
            } else {
                height = $('#' + this.current, this.container).outerHeight(true)
            }

            $(this.container).height(height) // set height
        }
    }
}
