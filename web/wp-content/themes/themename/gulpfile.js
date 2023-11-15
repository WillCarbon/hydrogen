'use strict';

/* ==========================================================================
   Settings
   ========================================================================== */

let devDomain = 'themename.localhost';

// Project path settings
const path = {
    web: '../../../',
    load: './node_modules/'
};

// Additional path settings
path.assets     = 'assets/';
path.svgPath    = 'assets/svg/';
path.svgDest    = 'assets/svg/sprites/';

// SVG Merged Stacks
const spriteFiles = [
    path.svgPath + 'icons/*.svg',
    path.svgPath + 'social/*.svg'
];

// CSS config
const cssConf = {
    src: 'assets/css/src/*.scss',
    sub: 'assets/css/src/**/*.scss',
    build: 'assets/css/dist/'
};

// JavaScript config
const jsConf = {
    src: 'assets/js/src/*.js',
    sub: 'assets/js/src/**/*.js',
    vue: 'assets/js/src/**/*.vue',
    build: 'assets/js/dist/'
};

/* ==========================================================================
   Packages
   ========================================================================== */

const { src, dest, watch, series, parallel } = require('gulp');

const log           = require('fancy-log');
const tap           = require('gulp-tap');
const cache         = require('gulp-cached');
const sourcemaps    = require('gulp-sourcemaps');
const rename        = require('gulp-rename');
const fPath         = require('path');

/* ==========================================================================
   Browser Sync
   ========================================================================== */

const browserSync   = require('browser-sync').create();

function server (done) {
    browserSync.init({
        proxy: devDomain,
        ghostMode: false,
        notify: false,
        open: false
    });

    done();
}

function browserSyncReload (done) {
    browserSync.reload();
    done();
}

/* ==========================================================================
   Styles
   ========================================================================== */

const autoprefixer  = require('autoprefixer');
const assets        = require('postcss-assets');
const cleanCSS      = require('gulp-clean-css');
const objectfit     = require('postcss-object-fit-images');
const postcss       = require('gulp-postcss');
const responsive    = require('postcss-responsive-type');
const sass          = require('gulp-sass')(require('sass'));
const sasslint      = require('gulp-sass-lint');

let processors = [
    autoprefixer,
    objectfit,
    responsive,
    assets({
        loadPaths: [
            path.assets + 'images/',
            path.assets + 'svg/'
        ]
    })
];

/* Style Lint */
function lintStyles () {
    return src([cssConf.sub, cssConf.src])
        .pipe(cache('sasslint'))
        .pipe(sasslint({
            configFile: '.sass-lint.yml'
        }))
        .pipe(sasslint.format())
        .pipe(sasslint.failOnError());
}

/* Development Styling */
function devStyles () {
    return src(cssConf.src)
        .pipe(tap(function (file) {
            log.info('⚙️ ' + ' compiling: ' + file.path);
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: [path.load]
        }).on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(cssConf.build));
}

/* Production Styling */
function distStyles () {
    return src(cssConf.src)
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(tap(function (file) {
            log.info('⚙️ ' + ' compiling: ' + file.path);
        }))
        .pipe(sass({
            includePaths: [path.load]
        }).on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(cleanCSS())
        .pipe(dest(cssConf.build))
        .pipe(browserSync.stream({match: '**/*.css'}));
}

/* Styling Task */
exports.styling = series(lintStyles, devStyles, distStyles);

/* ==========================================================================
   Scripts
   ========================================================================== */

const babelify      = require('babelify');
const browserify    = require('browserify');
const buffer        = require('gulp-buffer');
const eslint        = require('gulp-eslint');
const uglify        = require('gulp-uglify');

function lintScripts () {
    return src([jsConf.sub, jsConf.src])
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

function devScripts () {
    return src(jsConf.sub, {read: false})
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
            file.contents = browserify(file.path, {debug: true}).transform(babelify.configure({
                presets: ['@babel/preset-env']
            })).bundle();
        }))
        .pipe(buffer())
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sourcemaps.write('./'))
        .pipe(dest(jsConf.build));
}

function distScripts () {
    return src(jsConf.sub, {read: false})
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
            file.contents = browserify(file.path, {debug: true}).transform(babelify.configure({
                presets: ['@babel/preset-env']
            })).bundle();
        }))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(dest(jsConf.build));
}

/* Styling Task */
exports.scripting = series(lintScripts, devScripts, distScripts);

/* ==========================================================================
   SVG Sprite
   ========================================================================== */

let symbols     = require('gulp-svg-symbols');
let merge       = require('merge-stream');

function sprite () {
    return merge(spriteFiles.map(function(folder) {
        return src(folder)
            .pipe(symbols({
                templates: ['default-svg'],
            }))
            .pipe(rename({
                basename: fPath.basename(fPath.dirname(folder))
            }))
            .pipe(tap(function (file) {
                log.info('🪄' + ' generating: ' + path.svgDest + file.path);
            }))
            .pipe(dest(path.svgDest));
    }));
}

exports.sprite = parallel(sprite);

/* ==========================================================================
   Watch 👀
   ========================================================================== */

function watching (done) {
    // Styling
    watch(
        [cssConf.src, cssConf.sub],
        { events: 'all', ignoreInitial: false },
        series(lintStyles, devStyles, distStyles)
    );

    // JavaScript
    watch(
        [jsConf.src, jsConf.sub, jsConf.vue],
        { events: 'all', ignoreInitial: false },
        series(lintScripts, devScripts, distScripts, browserSyncReload)
    );

    // .html/.php
    watch(
        ['*.php', '**/*.php'],
        { events: 'all', ignoreInitial: false },
        browserSyncReload
    );

    done();
}

exports.watch = parallel(server, distStyles, distScripts, watching);

/* ==========================================================================
   Production 🚀
   ========================================================================== */

exports.build = series(sprite, distStyles, distScripts);
