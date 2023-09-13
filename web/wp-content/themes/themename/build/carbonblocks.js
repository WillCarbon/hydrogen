/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./js/src/blocks/types/carbon-image-text.js":
/*!**************************************************!*\
  !*** ./js/src/blocks/types/carbon-image-text.js ***!
  \**************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);


(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)('carbon/image-text', {
  apiVersion: 2,
  title: 'Image & Text',
  category: 'media',
  icon: 'align-pull-left',
  edit: function edit() {
    var template = [['core/media-text', {
      mediaPosition: 'right'
    }, [['core/heading', {
      placeholder: 'Lorem ipsum dolor sit amet...'
    }], ['core/paragraph', {
      placeholder: 'Et leo duis ut diam quam nulla porttitor. Justo eget magna fermentum iaculis eu non diam phasellus. Cras sed felis eget velit aliquet sagittis. Porttitor massa id neque aliquam vestibulum morbi blandit cursus risus...'
    }]]]];
    return /*#__PURE__*/React.createElement("div", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)(), /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, {
      orientation: "horizontal",
      template: template,
      templateLock: "all"
    }));
  },
  save: function save() {
    return /*#__PURE__*/React.createElement("div", _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save(), /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null));
  }
});

/***/ }),

/***/ "./js/src/blocks/types/carbon-text.js":
/*!********************************************!*\
  !*** ./js/src/blocks/types/carbon-text.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);


(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)('carbon/text', {
  apiVersion: 2,
  title: 'Text',
  category: 'text',
  icon: 'text',
  edit: function edit() {
    var allowedBlocks = ['core/paragraph', 'core/heading', 'core/list'],
      template = [['core/group', {}, [['core/heading', {
        placeholder: 'Lorem ipsum dolor sit amet...',
        lock: {
          move: false,
          remove: true
        }
      }], ['core/paragraph', {
        placeholder: 'Et leo duis ut diam quam nulla porttitor. Justo eget magna fermentum iaculis eu non diam phasellus. Cras sed felis eget velit aliquet sagittis. Porttitor massa id neque aliquam vestibulum morbi blandit cursus risus...',
        lock: {
          move: false,
          remove: true
        }
      }], ['core/paragraph', {
        placeholder: 'Et leo duis ut diam quam nulla porttitor. Justo eget magna fermentum iaculis eu non diam phasellus. Cras sed felis eget velit aliquet sagittis. Porttitor massa id neque aliquam vestibulum morbi blandit cursus risus...',
        lock: {
          move: false,
          remove: true
        }
      }]]]];
    return /*#__PURE__*/React.createElement("div", _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps, /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, {
      allowedBlocks: allowedBlocks,
      orientation: "horizontal",
      template: template
    }));
  },
  save: function save() {
    return /*#__PURE__*/React.createElement("div", _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save(), /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null));
  }
});

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/dom-ready":
/*!**********************************!*\
  !*** external ["wp","domReady"] ***!
  \**********************************/
/***/ (function(module) {

module.exports = window["wp"]["domReady"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!********************************!*\
  !*** ./js/src/carbonblocks.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/dom-ready */ "@wordpress/dom-ready");
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _blocks_types_carbon_image_text__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./blocks/types/carbon-image-text */ "./js/src/blocks/types/carbon-image-text.js");
/* harmony import */ var _blocks_types_carbon_text__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./blocks/types/carbon-text */ "./js/src/blocks/types/carbon-text.js");
/* eslint-disable */





// import './blocks/variations/media-text-img-left';
// import './blocks/variations/media-text-img-right';

_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_1___default()(function () {
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockStyle)('core/image', 'rounded');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockStyle)('core/button', 'outline');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockVariation)('core/columns', 'one-column-full');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockVariation)('core/columns', 'two-columns-one-third-two-thirds');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockVariation)('core/columns', 'two-columns-two-thirds-one-third');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.unregisterBlockVariation)('core/columns', 'three-columns-wider-center');
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_2__.registerBlockStyle)('carbon/media-text', {
    name: 'img-right',
    label: 'Image to the right'
  });
});

/* eslint-enable */
}();
/******/ })()
;
//# sourceMappingURL=carbonblocks.js.map