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

            // Hide paragraph
            paragraph.style.display = 'none';

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
     * @param {String} choosenId The slide id.
     */
    Slider.prototype.slideTo = function (choosenId) {
        var choicesList = this.choices;
        var choicesCtn = this.ctn;

        var currentParagraph = null;
        var choosenParagraph = null;
        var animationDirection = '';

        for (var i = 0; i < choicesList.length; i++) {
            var choiceId = choicesList[i];

            var link = choicesCtn.getElementsByClassName(choiceId)[0];
            var paragraph = document.getElementById(choiceId);

            if (paragraph.style.display != 'none') { // This paragraph is currently visible
                if (choosenParagraph) {
                    animationDirection = 'right';
                }
                currentParagraph = paragraph;

                if (choiceId == choosenId) { // Want to go to an already visible paragraph
                    return;
                }
            }

            if (choiceId == choosenId) {
                link.classList.add('active');

                if (currentParagraph) {
                    animationDirection = 'left';
                }
                choosenParagraph = paragraph;
            } else {
                link.classList.remove('active');
            }
        }

        // Should we make a nice transition?
        if (animationDirection && transitionsSupported() &&
            currentParagraph.classList.contains('slide') && choosenParagraph.classList.contains('slide')) {
            document.body.classList.add('sliding');

            currentParagraph.classList.add('slide-out');
            choosenParagraph.classList.add('slide-in');

            currentParagraph.classList.add('slide-'+animationDirection);
            choosenParagraph.classList.add('slide-'+animationDirection);

            if (animationDirection == 'left') {
                currentParagraph.style.top = '0';
                choosenParagraph.style.top = '-'+currentParagraph.clientHeight+'px';
            } else {
                choosenParagraph.style.top = '0';
            }

            choosenParagraph.style.display = 'block';

            // Wait for the DOM to be rendered
            setTimeout(function () {
                currentParagraph.classList.add('sliding');
                choosenParagraph.classList.add('sliding');

                if (animationDirection == 'right') {
                    currentParagraph.style.top = '-'+choosenParagraph.clientHeight+'px';
                }
            }, 20);

            var onFinish = function () {
                choosenParagraph.removeEventListener('transitionend', onFinish);

                currentParagraph.style.display = 'none';
                currentParagraph.style.top = '0';
                choosenParagraph.style.top = '0';

                currentParagraph.classList.remove('sliding');
                choosenParagraph.classList.remove('sliding');

                currentParagraph.classList.remove('slide-out');
                choosenParagraph.classList.remove('slide-in');

                currentParagraph.classList.remove('slide-'+animationDirection);
                choosenParagraph.classList.remove('slide-'+animationDirection);

                document.body.classList.remove('sliding');
            };
            choosenParagraph.addEventListener('transitionend', onFinish);
        } else {
            if (currentParagraph) {
                currentParagraph.style.display = 'none';
            }
            choosenParagraph.style.display = 'block';
        }
    };

    // Export API
    global.Slider = Slider;
})(window);