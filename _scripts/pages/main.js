/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

import jQuery from "~/lib/jquery";

import "~/external-links";
import "~/popover";
import "~/smooth-scrolling";

jQuery.then(($) => {
    $(".toast__close").on("click", function (e) {
        $(this).closest(".toast").hide();
    });
});

/* Can't wait for JQuery. This needs to run ASAP to prevent flashes */
(function (body) {
    let menuButton = body.querySelector("nav .menu-button");
    menuButton.classList.add("enabled");

    menuButton.addEventListener("click", function (e) {
        if (menuButton.getAttribute("aria-expanded") === "true") {
            menuButton.setAttribute("aria-expanded", "false");
        } else {
            menuButton.setAttribute("aria-expanded", "true");
        }
    });
})(document.body);
