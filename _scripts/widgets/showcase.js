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

        const $container = $(this.container)

        // update aria-expanded to alert which slide is active
        $container.find('button[aria-controls]').each(function() {
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

        /**
         * unhide a specific jQuery element
         * 
         * we first set the hidden attribute to false, so that the DOM tree
         * can update. we then set the active class on the next frame to allow
         * the animation to play nicely
         * 
         * @param {*} $target 
         */
        const unhide = function($target) {
            $target.attr('hidden', false)
            requestAnimationFrame(function() {
                $target.addClass('active')
            })
            $target.find('.showcase-back').attr('tabindex', 0)
        }

        /**
         * hide a specific jQuery element
         * 
         * we don't need to worry about any animation frames here!
         * 
         * @param {*} $target 
         */
        const hide = function($target) {
            $target.removeClass('active')
            $target.find('.showcase-back').attr('tabindex', -1)
            $targetsToHide.push($target)
        }

        const $indexSlide = $(this.index, this.container)

        if (rSlide === 'index') {
            unhide($indexSlide)

            if (this.current) {
                // focus the previous button when returning to the index
                $targetToFocus = $('button[aria-controls="' + this.current + '"]')
            }
            else {
                $targetToFocus = $(this.index)
            }
        } else {
            hide($indexSlide)
        }

        // iterates through slides based on this.slides
        for (let i = 0; i < this.slides.length; i++) {
            const n = this.slides[i]
            const $n = $('#' + n, this.container) // current iterated slide

            if (n === rSlide) { // if correct slide
                unhide($n)
                $targetToFocus = $n
            } else {
                hide($n)
            }
        }

        this.current = rSlide
        $container.trigger('change', {
            active: rSlide
        })

        if (this.current !== 'index') {
            $('body').animate({
                scrollTop: $container.offset().top
            }, 100)
        }

        this.resize() // resize the container

        // hide and focus roughly after animations are complete
        $container.one('transitionend', function() {
            for (const $target of $targetsToHide) {
                $target.attr('hidden', true)
            }
            $targetToFocus.focus()
        })
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
