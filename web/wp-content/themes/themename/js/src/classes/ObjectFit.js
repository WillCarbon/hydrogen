// Polyfill for browsers that don't support object-fit
// Uses var instead of let to support older browsers

/*eslint-disable */
if (!Modernizr.objectfit) {
    var objectFitImages = document.querySelectorAll('.c-object-fit');

    [].forEach.call(objectFitImages, function (container) {
        container.classList.add('c-object-fit--polyfill');
        var image = container.querySelector('img').getAttribute('src');
        container.style.backgroundImage = "url('" + image + "')";
    });
}
/*eslint-enable */
