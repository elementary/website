(function (global) {
    function transitionsSupported() {
        return (typeof document.body.style.transition != 'undefined');
    }

    /**
     * A slider.
     * @param {Object} options Slider options.
     * @param {String} options.id The slider id. The associated element should contain the choices' switch.
     * @param {String[]} options.choices The slider choices ids. Each id should refer to a slide.
     * @param {Boolean} options.hideHeadings Automatically hide slides headings.
     */
    var Slider = function (options) {
        this.id = options.id;
        this.ctn = document.getElementById(this.id);
        this.choices = options.choices;

        var that = this;

        // Init
        var choicesCtn = this.ctn;
        var container = null;
        var firstParagraph = null;
        var maxHeight = 0;
        var processChoice = function (choiceId) {
            var link = choicesCtn.getElementsByClassName(choiceId)[0];
            var paragraph = document.getElementById(choiceId);
            if (!paragraph) {
                console.log('ERR: could not find paragraph #'+choiceId);
                return;
            }
            if (!container) { // First paragraph
                firstParagraph = paragraph;
                container = paragraph.parentNode;
            }
            if (container.classList.contains('slide-fixed-height')) {
                maxHeight = Math.max(maxHeight, paragraph.offsetHeight);
            }

            // Hide heading
            if (options.hideHeadings) {
                var heading = paragraph.getElementsByTagName('h2')[0]
                    || paragraph.getElementsByTagName('h3')[0];
                if (heading) {
                    heading.style.display = 'none';
                }
            }

            link.addEventListener('click', function (e) {
                e.preventDefault();
                that.slideTo(choiceId);
            });
        };

        for (var i = 0; i < this.choices.length; i++) {
            processChoice(this.choices[i]);
        }

        // If the slider has a fixed height
        if (maxHeight) {
            // Wait for the DOM to be rendered
            setTimeout(function () {
                var diff = container.offsetHeight - firstParagraph.offsetHeight;
                container.style.height = (maxHeight + diff)+'px';
            }, 0);
        }
    };

    /**
     * Show a specific slide.
     * @param {String} chosenId The slide id.
     */
    Slider.prototype.slideTo = function (chosenId) {
        var choicesList = this.choices;
        var choicesCtn = this.ctn;

        var currentParagraph = null;
        var chosenParagraph = null;

        for (var i = 0; i < choicesList.length; i++) {
            var choiceId = choicesList[i];

            var link = choicesCtn.getElementsByClassName(choiceId)[0];
            var paragraph = document.getElementById(choiceId);

            if (choiceId == chosenId) {
                link.classList.add('active');
                chosenParagraph = paragraph;
                chosenParagraph.classList.add('active');
                chosenParagraph.classList.remove('next');
                chosenParagraph.classList.remove('previous');
                currentPosition = i;
            } else {
                link.classList.remove('active');
            }

            if (paragraph.classList.contains('active')) { // This paragraph is currently visible
                currentParagraph = paragraph;
                if (chosenParagraph != currentParagraph) {
                    currentParagraph.classList.remove('active');
                    if (i > currentPosition ) {
                        currentParagraph.classList.add('next');
                    } else {
                        currentParagraph.classList.add('previous');
                    }
                }
            }

        }

    };

    // Export API
    global.Slider = Slider;
})(window);
