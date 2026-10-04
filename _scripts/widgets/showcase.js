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
        this.timeout = false

        this.current = null
    }

    /**
     * start
     * Starts javascript logic for showcase
     * NOTE: must be ran before any other functions so jQuery is loaded!
     */
    start () {
        for (let i = 0; i < this.slides.length; i++) {
            const n = this.slides[i]
            const $iChoice = $("[aria-controls='" + n + "']", this.container)
            const $iContainer = $('#' + n, this.container)

            $iContainer.prepend('<button type="button" class="showcase-back" aria-controls="showcase-index" aria-expanded="false" aria-label="Back" tabindex="-1"></button>')

            // each choice button
            const that = this
            $iChoice.on('click', function (e) {
                e.preventDefault()
                that.slideTo($(this).attr('aria-controls')) // slide on click of button
            })
        }

        $(window).resize(() => this.resize())

        this.slideTo('index')
        $(this.container).addClass('initialized')
        $(this.container).scrollLeft(0)

        // Listen for some cool mobile touch gestures
        let touchStartX = null
        let touchStartY = null

        $(document).on('touchstart', this.container, (e) => {
            touchStartX = e.touches[0].pageX
            touchStartY = e.touches[0].pageY
        })

        $(document).on('touchend', (e) => {
            const touchEndX = e.changedTouches[e.changedTouches.length - 1].pageX
            const touchEndY = e.changedTouches[e.changedTouches.length - 1].pageY

            const movementX = touchEndX - touchStartX
            const movementY = touchEndY - touchStartY

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

        // update aria-expanded to alert which slide is active
        $(this.container).find('button[aria-controls]').each(function() {
            const $button = $(this)
            if ($button.attr('aria-controls') === rSlide) {
                $button.attr('aria-expanded', true)
            }
            else {
                $button.attr('aria-expanded', false)
            }
        })

        // we want to only mark them as hidden after some time has elapsed
        // this allows us to keep the slide height animation
        let $targetsToHide = [];
        let $targetToFocus = false;

        if (rSlide === 'index') {
            $(this.index, this.container).addClass('active').attr('hidden', false)
            if (this.current) {
                $targetToFocus = $('button[aria-controls="' + this.current + '"]')
            }
            else {
                $targetToFocus = $(this.index)
            }
        } else {
            $(this.index, this.container).removeClass('active')
            $targetsToHide.push($(this.index, this.container))
        }

        // iterates through slides based on this.slides
        for (let i = 0; i < this.slides.length; i++) {
            const n = this.slides[i]
            const $n = $('#' + n, this.container) // current iterated slide

            if (n === rSlide) { // if correct slide
                $n.addClass('active').attr('hidden', false)
                $n.find('.showcase-back').attr('tabindex', 0)
                $targetToFocus = $n
            } else {
                $n.removeClass('active')
                $n.find('.showcase-back').attr('tabindex', -1)
                $targetsToHide.push($n)
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

        // hide and focus roughly after animations are complete
        clearTimeout(this.timeout)
        this.timeout = setTimeout(function() {
            for (const $target of $targetsToHide) {
                $target.attr('hidden', true)
            }
            $targetToFocus.focus()
        }, 500)
    }

    /**
     * resize
     * Reset height of container
     */
    resize () {
        let height = 0

        if (this.fixed) { // if the container should be a fixed height
            height = $(this.index, this.container).outerHeight(true)

            // iterates through slides
            $.each(this.slides, function (i, n) {
                const $iSlide = $('#' + n, this.container) // current iterated slide

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
