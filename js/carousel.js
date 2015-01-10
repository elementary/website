(function () {
    "use strict";
    // Safari 8 freezes when you try to animate clip-path via JS. No idea why.
    var animate = !/^((?!chrome).)*safari/i.test(navigator.userAgent);

    var animationDuration = animate ? 400 : 0;

    function activateCarousel(carousel) {
        carousel.classList.add('active');
        var menuItems = carousel.querySelectorAll('.menu button');
        var slides = carousel.querySelectorAll('.slides > div');

        function setClipPath(element, size, x) {
            if (animate) {
                var circle = 'circle(' + size + ' at ';
                if (x === 'center') {
                    circle += 'center center';
                } else {
                    circle += String(((x - 1) / menuItems.length + 0.5) * 100) + '% 0';
                }
                circle += ')';

                element.style.setProperty('-webkit-clip-path', circle);
                element.style.setProperty('clip-path', circle);
            }
        }

        function menuItemClicked(e) {
            var i = Number(e.target.getAttribute('data-slide'));
            var newSlide = slides[e.target.getAttribute('data-slide')];
            if (!newSlide.classList.contains('active')) {
                setTimeout(function() {
                    for (var j = 0, slide; slide = slides[j]; j++) {
                        if (i !== j) {
                            setClipPath(slide, 0, j);
                        }
                    }
                }, animationDuration);

                for (var j = 0, slide; slide = slides[j]; j++) {
                    slide.classList.remove('active');
                }

                if (newSlide) {
                    setClipPath(newSlide, 0, i);
                    newSlide.classList.add('active');
                    setClipPath(newSlide, '100%', 'center');
                }
            }
        }

        for (var i = 0, menuItem; menuItem = menuItems[i]; i++) {
            menuItem.addEventListener('click', menuItemClicked);
        }
        menuItemClicked({ target: menuItems[0] });
    }



    if (window.DOMTokenList && document.querySelectorAll) {
        // <=IE8 will fail this, and fallback to displaying all images
        var carousels = document.getElementsByClassName('carousel');
        for (var i = 0, carousel; carousel = carousels[i]; i++) {
            activateCarousel(carousel);
        }
    }
})();
