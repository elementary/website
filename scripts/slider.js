(function (global) {
    function transitionsSupported() {
        return (typeof document.body.style.transition != 'undefined');
    }

    /**
     * A slider.
     * @param {Object} options Slider options.
     * @param {String} options.slidesContainer The slider container id.
     * @param {String} options.choicesContainer The choices container id.
     * @param {String} options.id The slider id. The associated element should contain the choices' switch.
     * @param {String[]} options.choices The slider choices ids. Each id should refer to a slide.
     * @param {Boolean} options.hideHeadings Automatically hide slides headings.
     */
    var Slider = function (options) {
        this.id = options.id;
        this.slidesContainer = options.slidesContainer;
        this.choicesContainer = options.choicesContainer;
        this.elemSlidesContainer = $('.'+this.slidesContainer);
        this.elemChoicesContainer = $('.'+this.choicesContainer);
        this.elemChoicesSwitcher = $('#'+this.id);
        this.choices = options.choices;

        var that = this;

        // Init
        var choicesSwitcher = this.elemChoicesSwitcher;
        var container = null;
        var biggestHeight = 0;
        var initializeChoice = function (choiceId) {

            $link = $('.' + that.choicesContainer + ' .' + choiceId);
            $Slide = $('#' + choiceId);

            if (!$Slide.length) {
                console.log('ERR: could not find slide #'+choiceId);
                return;
            }

            // Hide Headings
            if (options.hideHeadings) {
                $Slide.addClass('hide-headings');
            }

            // Increment biggestHeight
            var newHeight = $Slide.outerHeight(true);
            if ( newHeight > biggestHeight ) {
                biggestHeight = newHeight;
            }

            // Slide to on Link.Click
            $link.click(function(e) {
                e.preventDefault();
                that.slideTo(choiceId);
            });

            $Slide.addClass('next');

        };

        for (var i = 0; i < this.choices.length; i++) {
            initializeChoice(this.choices[i]);
        }

        // Add the switcher if that's in the container.
        $contSwitcher = $('.' + this.slidesContainer + ' .' + this.choicesContainer);
        if ($contSwitcher.length) {
            biggestHeight = biggestHeight + $contSwitcher.outerHeight(true);
        }

        // Wait for the DOM to be rendered
        setTimeout(function () {
            that.elemSlidesContainer.css('min-height', biggestHeight);
        }, 0);
    };

    /**
     * Show a specific slide.
     * @param {String} chosenId The slide id.
     */
    Slider.prototype.slideTo = function (chosenId) {
        var choicesList = this.choices;
        var choicesContainer = this.choicesContainer;

        var currentSlide = null;
        var chosenSlide = null;

        for (var i = 0; i < choicesList.length; i++) {
            var choiceId = choicesList[i];

            $link = $('.' + choicesContainer + ' .' + choiceId);
            $Slide = $('#' + choiceId);

            if (choiceId == chosenId) {
                $link.addClass('active');
                $chosenSlide = $Slide;
                $chosenSlide.addClass('active').removeClass('next previous');
                currentPosition = i;
            } else {
                $link.removeClass('active').addClass('previous');
            }

            if ($Slide.hasClass('active')) { // This Slide is currently visible
                $currentSlide = $Slide;
                if ($chosenSlide != $currentSlide) {
                    $currentSlide.removeClass('active');
                    if (i > currentPosition ) {
                        $currentSlide.addClass('next');
                    } else {
                        $currentSlide.addClass('previous');
                    }
                }
            }

        }

    };

    // Export API
    global.Slider = Slider;
})(window);
