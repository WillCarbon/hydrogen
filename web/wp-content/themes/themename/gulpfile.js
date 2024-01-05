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
    blocks: 'assets/css/src/blocks/*.scss',
    build: 'assets/css/dist/',
};

// JavaScript config
const jsConf = {
    base: 'assets/js/src/',
    cat: 'assets/js/src/**/',
    src: 'assets/js/src/*.js',
    sub: 'assets/js/src/**/*.js',
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
const postcss       = require('gulp-postcss');
const sass          = require('gulp-sass')(require('sass'));
const sasslint      = require('gulp-sass-lint');

let processors = [
    autoprefixer,
    assets({
        loadPaths: [
            path.assets + 'images/',
            path.assets + 'svg/'
        ]
    })
];

// Style Lint
function lintStyles () {
    return src([cssConf.sub, cssConf.src])
        .pipe(cache('sasslint'))
        .pipe(sasslint({
            configFile: '.sass-lint.yml'
        }))
        .pipe(sasslint.format())
        .pipe(sasslint.failOnError());
}

// Development Styling
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

// Production Styling
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

const buffer        = require('gulp-buffer');
const eslint        = require('gulp-eslint');
const uglify        = require('gulp-uglify');
const concat    = require('gulp-concat-flatten');
const sort      = require('gulp-sort');

function lintScripts () {
    return src([jsConf.src, jsConf.sub])
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

function devScriptFiles () {
    return src([jsConf.src])
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(buffer())
        .pipe(dest(jsConf.build));
}

function devScriptFolders () {
    return src([jsConf.sub, '!' + jsConf.src])
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(sort())
        .pipe(concat(jsConf.cat, 'js', {'newLine': '\n\n'}))
        .pipe(rename( {
            dirname: ''
        }))
        .pipe(dest(jsConf.build));
}

function distScriptFiles () {
    return src([jsConf.src])
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(dest(jsConf.build));
}

function distScriptFolders () {
    return src([jsConf.sub, '!' + jsConf.src])
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(sort())
        .pipe(uglify())
        .pipe(concat(jsConf.cat, 'js', {'newLine': '\n\n'}))
        .pipe(rename( {
            dirname: '',
            suffix: '.min'
        }))
        .pipe(dest(jsConf.build));
}

/* Styling Task */
exports.scripting = series(lintScripts, devScriptFiles, devScriptFolders, distScriptFiles, distScriptFolders);
// exports.scripting = series(distScriptFiles);

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
        [cssConf.src, cssConf.sub, cssConf.blocks],
        { events: 'all', ignoreInitial: false },
        series(lintStyles, devStyles, distStyles)
    );

    // JavaScript
    watch(
        [jsConf.src, jsConf.sub],
        { events: 'all', ignoreInitial: false },
        series(lintScripts, devScriptFiles, devScriptFolders, distScriptFiles, distScriptFolders, browserSyncReload)
    );

    // .html/.php
    watch(
        ['*.php', '**/*.php'],
        { events: 'all', ignoreInitial: false },
        browserSyncReload
    );

    done();
}

exports.watch = parallel(server, distStyles, devScriptFiles, devScriptFolders, distScriptFiles, distScriptFolders, watching);

/* ==========================================================================
   Production 🚀
   ========================================================================== */

exports.build = series(sprite, distStyles, devScriptFiles, devScriptFolders, distScriptFiles, distScriptFolders);
