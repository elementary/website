(function () {
    // Install guide toggles
    var toggles = {
        'carousel-choices': ['photos', 'music']
    };

    // Parse user-agent to detect current plateform
    function detectOS() {
        var ua = window.navigator.userAgent;
        if (ua.indexOf('Windows') >= 0) {
            return 'windows';
        }
        if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
            return 'osx';
        }
        if (ua.indexOf('Linux') >= 0) {
            return 'linux';
        }
    }

    function transitionsSupported() {
        return (typeof document.body.style.transition != 'undefined');
    }

    // Show instructions for a platform
    function selectChoice(toggleId, choosenId) {
        var choicesList = toggles[toggleId];
        var choicesCtn = document.getElementById(toggleId);

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

        var container = choosenParagraph.parentNode;

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

            // Delay for Firefox
            setTimeout(function () {
                currentParagraph.classList.add('sliding');
                choosenParagraph.classList.add('sliding');

                if (animationDirection == 'right') {
                    currentParagraph.style.top = '-'+choosenParagraph.clientHeight+'px';
                }

                if (container.classList.contains('slide-container')) {
                    var maxHeight = Math.max(currentParagraph.offsetHeight, currentParagraph.offsetHeight);
                    container.style.height = maxHeight+'px';
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
    }

    function setupToggle(toggleId) {
        var choicesList = toggles[toggleId];
        var choicesCtn = document.getElementById(toggleId);

        var processChoice = function (choiceId) {
            var link = choicesCtn.getElementsByClassName(choiceId)[0];
            var paragraph = document.getElementById(choiceId);
            if (!paragraph) {
                console.log('ERR: could not find paragraph #'+choiceId);
                return;
            }
            var heading = paragraph.getElementsByTagName('h2')[0];
            if (!heading) {
                heading = paragraph.getElementsByTagName('h3')[0];
            }

            // Hide heading

            paragraph.style.display = 'none';

            link.addEventListener('click', function (e) {
                e.preventDefault();
                selectChoice(toggleId, choiceId);
            });
        };

        for (var i = 0; i < choicesList.length; i++) {
            processChoice(choicesList[i]);
        }
    }

    // Setup toggles
    for (var toggleId in toggles) {
        setupToggle(toggleId);
    }

    selectChoice('carousel-choices', 'photos');
})();
