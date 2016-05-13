(function (global) {

    /**
     * A showcase slider for elementary homepage.
     * @param {Object} options - Slider options.
     * @param {String} options.container - The slider container.
     * @param {String} options.index - The container holding all the choices.
     * @param {String[]} options.slides - The slider choices selectors.
     * @param {Boolean} options.fixed - Update container height based on slide.
     */
    var Showcase = function(options) {
        this.container = options.container || '#showcase';
        this.index = options.index || '#showcase-index';
        this.slides = options.slides;
        this.fixed = options.fixed;

        this.current = null;

        // initial setup
        var that = this;

        for (var i = 0; i < this.slides.length; i++) {
            var n = this.slides[i];
            var $iChoice = $("[href$='" + n + "']" , this.container);

            $("#" + n, this.container).prepend('<div class="showcase-back"></div>');

            // each choice button
            $iChoice.on("click", function(e) {
                e.preventDefault();
                that.slideTo($(this).attr("href").split("#").pop()); // slide on click of button
            });
        }

        $(window).resize(function() {
            that.resize();
        });

        $(window).on("hashchange", function(e) {
            if (that.current !== 'index') {
                that.slideTo('index');
            }
        });

        $(this.container).addClass('initialized');

        var hash = window.location.hash.split('#')[1]
        if (this.slides.indexOf(hash) !== -1) {
            this.slideTo(hash);
        } else {
            this.slideTo('index');
        }
    };

    /**
     * Show a specific slide.
     * @param {String} rSlide The slide id.
     */
    Showcase.prototype.slideTo = function(rSlide) {
        if (rSlide !== 'index' && this.slides.indexOf(rSlide) === -1) { // could not find requested slide
            return console.log("ERROR: could not find requested slide '" + rSlide + "'"); // log an error
        }

        if (rSlide === 'index') {
            $(this.index, this.container).addClass("active");
        } else {
            $(this.index, this.container).removeClass("active");
        }

        // iterates through slides based on this.slides
        for (var i = 0; i < this.slides.length; i++) {
            var n = this.slides[i];
            var $n = $("#" + n, this.container); // current iterated slide

            if (n == rSlide) { // if correct slide
                $n.addClass("active");
            } else {
                $n.removeClass("active");
            }
        };

        if (rSlide === 'index') {
            var location = window.location.href.split("#")[0]
        } else {
            var location = window.location.href.split("#")[0] + "#" + rSlide
        }

        if (rSlide !== 'index') {
            window.history.pushState(undefined, undefined, location);
        }

        this.current = rSlide;

        this.resize(); // resize the container
    };

    /**
     * Reset height of container
     */
    Showcase.prototype.resize = function() {
        if (this.fixed) { // if the container should be a fixed height
            var height = $(this.index, this.container).outerHeight(true);

            // iterates through slides
            $.each(this.slides, function(i, n) {
                var $iSlide = $("#" + n, this.container); // current iterated slide

                if ($iSlide.outerHeight(true) > height) { // new tallest slide
                    height = $iSlide.outerHeight(true);
                }
            });

            $(this.container).height(height); // set fixed height
        } else { // resize container based on slide
            if (this.current === 'index') {
                var height = $(this.index, this.container).outerHeight(true);
            } else {
                var height = $("#" + this.current, this.container).outerHeight(true);
            }

            $(this.container).height(height); // set height
        }
    };

    // Export API
    global.Showcase = Showcase;
})(window);
