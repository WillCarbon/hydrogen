const pageHead = document.querySelector( 'head' );
const elements = [ 'input', 'select', 'textarea' ];

// Disable zooming
const zoomDisable = function() {
    const metaViewport = document.querySelector( 'meta[name=viewport]' );
    metaViewport.parentNode.removeChild( metaViewport );
    pageHead.appendChild( createElement( 0 ) );
};

// Re-enable zooming
const zoomEnable = function() {
    const metaViewport = document.querySelector( 'meta[name=viewport]' );
    metaViewport.parentNode.removeChild( metaViewport );
    pageHead.appendChild( createElement( 1 ) );
};

// Check if the device is an iProduct
if ( navigator.userAgent.length && /iPhone|iPad|iPod/i.test( navigator.userAgent ) ) {
    document.addEventListener( 'touchstart', function( e ) {
        if ( ! isElement( e ) ) {
            return;
        }
        zoomDisable();
    } )

    document.addEventListener( 'touchend', function( e ) {
        if ( ! isElement( e ) ) {
            return;
        }
        setTimeout( zoomEnable, 500 );
    } )
}

// Create new meta element
function createElement( userScalable ) {
    const meta = document.createElement( 'meta' );
    meta.name = 'viewport';
    meta.setAttribute( 'content', 'width=device-width, initial-scale=1.0, user-scalable=' + userScalable );
    pageHead.appendChild( meta );
    return meta;
}

// Check if element is a form input
function isElement( e ) {
    const element = e.target.tagName;
    const inArray = elements.indexOf( element.toLowerCase() + '' );
    return ( inArray !== -1 );
}
