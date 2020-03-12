const pageHead = document.querySelector('head');
const elements = ['input', 'select', 'textarea'];

// Disable zooming
var zoomDisable = function () {
    let metaViewport = document.querySelector('meta[name=viewport]');
    metaViewport.parentNode.removeChild(metaViewport);
    pageHead.appendChild(createElement(0));
};

// Re-enable zooming
var zoomEnable = function () {
    let metaViewport = document.querySelector('meta[name=viewport]');
    metaViewport.parentNode.removeChild(metaViewport);
    pageHead.appendChild(createElement(1));
};

// Check if the device is an iProduct
if (navigator.userAgent.length && /iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    document.addEventListener('touchstart', function (e) {
        if (!isElement(e)) return;
        zoomDisable();
    })

    document.addEventListener('touchend', function (e) {
        if (!isElement(e)) return;
        setTimeout(zoomEnable, 500);
    })
}

// Create new meta element
function createElement (userScalable) {
    let meta = document.createElement('meta');
    meta.name = 'viewport';
    meta.setAttribute('content', 'width=device-width, initial-scale=1.0, user-scalable=' + userScalable);
    pageHead.appendChild(meta);
    return meta;
}

// Check if element is a form input
function isElement (e) {
    let element = e.target.tagName;
    let inArray = elements.indexOf(element.toLowerCase() + '');
    return (inArray !== -1);
}
