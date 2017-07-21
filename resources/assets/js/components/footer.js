footer = {};

/**
 * Adjust the footer position state and content padding
 */
footer.autoPosition = function () {
    var $footer = document.getElementById('footer');
    var contentHeight = document.body.clientHeight;
    var windowHeight = window.innerHeight;

    if (windowHeight > contentHeight) {
        $footer.classList.add('footer-fixed-bottom');
    } else {
        $footer.classList.remove('footer-fixed-bottom');
    }
};

window.addEventListener('resize', footer.autoPosition);

setInterval(footer.autoPosition, 100);
footer.autoPosition();