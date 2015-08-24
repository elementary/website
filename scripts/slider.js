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
        this.elemSlidesContainer.css('min-height', biggestHeight);

    };

    /**
     * Show a specific slide.
     * @param {String} chosenId The slide id.
     */
    Slider.prototype.slideTo = function (chosenId) {
        var choicesList = this.choices;
        var choicesContainer = this.choicesContainer;

        var $chosenSlide = null;

        for (var i = 0; i < choicesList.length; i++) {
            var choiceId = choicesList[i];

            $link = $('.' + choicesContainer + ' .' + choiceId);
            $Slide = $('#' + choiceId);

            // remove it until we find the chosen one
            $link.removeClass('active');

            // add class 'previous' until chosenId, then add 'next' class
            if (choiceId != chosenId && $chosenSlide == null) {
              $Slide.removeClass('next previous active').addClass('previous');
            } else if (choiceId == chosenId) {
              $Slide.removeClass('next previous active').addClass('active');
              $chosenSlide = $Slide;
              $link.addClass('active'); // clear before add
            } else if (choiceId != chosenId && $chosenSlide != null) {
              $Slide.removeClass('next previous active').addClass('next');
              $link.removeClass('')
            } else { // invalid selection
              $Slide.removeClass('next previous active');
            }

        }

    };

    // Export API
    global.Slider = Slider;
})(window);
