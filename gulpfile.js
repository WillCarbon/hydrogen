'use strict';

/* ==========================================================================
   Settings
   ========================================================================== */

const themeName = 'themename';
const devDomain = 'themename.localhost';


const path = {
    web:    './web/',
    load:   './node_modules/',
    theme:  './web/wp-content/themes/' + themeName + '/'
};

path.assets     = path.theme + 'assets/';
path.vendor     = path.theme + 'vendor/';

const cssConf = {
    src:    path.theme + 'styles/src/*.scss',
    sub:    path.theme + 'styles/src/**/*.scss',
    build:  path.theme + 'styles/dist/'
};

const jsConf = {
    src:    path.theme + 'js/src/*.js',
    sub:    path.theme + 'js/src/**/*.js',
    vue:    path.theme + 'js/src/**/*.vue',
    build:  path.theme + 'js/dist/'
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


/* ==========================================================================
   Browser Sync
   ========================================================================== */

const browserSync   = require('browser-sync');

function server (done)
{
    browserSync({
        proxy: devDomain,
        ghostMode: false,
        notify: false,
        open: false
    });

    done();
}


/* ==========================================================================
   CSS
   ========================================================================== */

const autoprefixer  = require('autoprefixer');
const assets        = require('postcss-assets');
const cleanCSS      = require('gulp-clean-css');
const objectfit     = require('postcss-object-fit-images');
const postcss       = require('gulp-postcss');
const responsive    = require('postcss-responsive-type');
const sass          = require('gulp-sass');
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
function lintStyles ()
{
    return src([cssConf.sub, cssConf.src])
        .pipe(cache('sasslint'))
        .pipe(sasslint({
            configFile: '.sass-lint.yml'
        }))
        .pipe(sasslint.format())
        .pipe(sasslint.failOnError());
}

/* Development Styling */
function devStyles ()
{
    return src(cssConf.src)
        .pipe(tap(function (file) {
            log(' - Compiling: ' + file.path);
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: [path.load]
        }).on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(cssConf.build))
        .pipe(browserSync.reload({ stream: true }));
}

/* Production Styling */
function distStyles ()
{
    return src(cssConf.src)
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(tap(function (file) {
            log(' - Compiling: ' + file.path);
        }))
        .pipe(sass({
            includePaths: [path.load]
        }).on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(cleanCSS())
        .pipe(dest(cssConf.build));
}

/* Styling Task */
exports.styling = series(lintStyles, devStyles, distStyles);

//gulp.task('styles', ['lint-styles'], function () {
//    var processors = [
//        cssImport({
//            path: [path.load]
//        }),
//        precss,
//        responsiveType,
//        assets({
//            path.loads: [
//                path.theme + '/assets/images',
//                path.theme + '/assets/svg'
//            ]
//        }),
//        autoprefixer({
//            browsers: ['last 2 versions', '> 5% in GB']
//        })
//    ];
//    return src(path.theme + '/styles/src/*.css')
//        .pipe(postcss(processors), {
//            syntax: scss
//        })
//        .pipe(dest(path.theme + '/styles/dist'))
//        .pipe(browserSync.stream());
//});
//
//gulp.task('dist-styles', function () {
//    var processors = [
//        cssImport({
//            path: [path.load]
//        }),
//        precss,
//        responsiveType,
//        assets({
//            path.loads: [
//                path.theme + '/assets/images',
//                path.theme + '/assets/svg'
//            ]
//        }),
//        autoprefixer({
//            browsers: ['last 2 versions', '> 5% in GB']
//        }),
//        cssnano({
//            discardComments: {
//                removeAll: true
//            },
//            discardEmpty: true,
//            calc: {
//                precision: 3
//            }
//        })
//    ];
//    return src(path.theme + '/styles/src/*.css')
//        .pipe(postcss(processors), {
//            syntax: scss
//        })
//        .pipe(dest(path.theme + '/styles/dist'));
//});


/* ==========================================================================
   Scripts
   ========================================================================== */

var browserify = require('browserify');
var babelify = require('babelify');
var buffer = require('gulp-buffer');
var eslint = require('gulp-eslint');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

function lintScripts ()
{
    return src([jsConf.sub, jsConf.src])
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

function devScripts ()
{
    return src(jsConf.sub, { read: false })
        .pipe(tap(function (file) {
            log(' - Bundling ' + file.path);
            file.contents = browserify(file.path, {
                debug: true,
                transform: [babelify]
            }).bundle();
        }))
        .pipe(buffer())
        .pipe(sourcemaps.init({
            loadMaps: true
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(dest(jsConf.build))
        .pipe(browserSync.stream());
}

function distScripts ()
{
    return src(jsConf.sub, { read: false })
        .pipe(tap(function (file) {
            log(' - Bundling ' + file.path);

            file.contents = browserify(file.path, {
                transform: [babelify]
            }).bundle();
        }))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(dest(jsConf.build));
}

/* Styling Task */
exports.scripting = series(lintScripts, devScripts, distScripts);

/* ==========================================================================
   Vendor Files
   ========================================================================== */

function vendor ()
{
    return src([
            path.load + 'jquery/dist/jquery.min.js'
        ], { 'base': path.load })
        .pipe(tap(function (file) {
            log(' - Coping File: ' + file.path);
        }))
        .pipe(dest(path.theme + '/vendor'));
}

exports.vendor = parallel(vendor);


/* ==========================================================================
   Watch
   ========================================================================== */

function watching (done)
{
    // Styling
    watch(
        [cssConf.src, cssConf.sub],
        { events: 'all', ignoreInitial: false },
        series(lintStyles, devStyles)
    );

    // JavaScript
    watch(
        [jsConf.src, jsConf.sub, jsConf.vue],
        { events: 'all', ignoreInitial: false },
        series(lintScripts, devScripts)
    );

    // .html/.php
    watch([
        path.theme + '/*.php',
        path.theme + '/**/*.php',
        path.theme + '/**/*.html'
    ], function (file) {
        src(file.path).pipe(browserSync.stream());
    });

    done();
}

exports.watch = parallel(server, vendor, devStyles, devScripts,  watching);


/* ==========================================================================
   Git Version Number
   ========================================================================== */

const git   = require('git-rev');
const fs    = require('fs');

function version ()
{
    return git.short(function (str) {
        fs.writeFile(
            path.web + 'version.php', "<?php define('SITE_VERSION', '" + str + "');",
            function () { return false; }
        );

       return log(' - website version: ' + str);
    });
}

exports.version = parallel(version);


/* ==========================================================================
   Production 🚀
   ========================================================================== */

exports.build = parallel(vendor, distStyles, distScripts, version);

