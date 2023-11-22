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
    src: 'assets/js/src/*.js',
    sub: 'assets/js/src/**/*.js',
    vue: 'assets/js/src/**/*.vue',
    build: 'assets/js/dist/'
};

// Blocks config
const blocksConf = {
    src: 'assets/css/src/blocks/*.scss',
    sub: 'assets/css/src/blocks/*.scss/**/*.scss'
};

/* ==========================================================================
   Packages
   ========================================================================== */

const { src, dest, watch, series, parallel } = require('gulp');

const log           = require('fancy-log');
const tap           = require('gulp-tap');
const cache         = require('gulp-cached');
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
   Clean
   ========================================================================== */

var rimraf = require('gulp-rimraf');

function cleanStyles () {
    return src(cssConf.build, { read: false, allowEmpty: true })
        .pipe(rimraf());
}

function cleanScripts () {
    return src(jsConf.build, { read: false, allowEmpty: true })
        .pipe(rimraf());
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
const sourcemaps    = require('gulp-sourcemaps');

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
function devStyles (dir) {
    return src(dir)
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

function devMainStyles () {
    return devStyles(cssConf.src)
}

function devBlockStyles () {
    return devStyles(cssConf.blocks)
}

// Production Styling
function distStyles (dir) {
    return src(dir)
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

function distMainStyles () {
    return distStyles(cssConf.src)
}

function distBlockStyles () {
    return distStyles(cssConf.blocks)
}

/* ==========================================================================
   Scripts
   ========================================================================== */

const esbuild       = require('gulp-esbuild');
const eslint        = require('gulp-eslint');

function lintScripts () {
    return src([jsConf.sub, jsConf.src])
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

function devScripts () {
    return src(jsConf.sub)
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(esbuild({
            bundle: true,
            sourcemap: 'external',
            loader: {
                '.js': 'js',
            },
        }))
        .pipe(dest(jsConf.build))
}

function distScripts () {
    return src(jsConf.sub)
        .pipe(tap(function (file) {
            log.info('📦' + ' bundling: ' + file.path);
        }))
        .pipe(esbuild({
            bundle: true,
            minify: true,
            outExtension: {
                '.js': '.min.js'
            },
            sourcemap: 'external',
            loader: {
                '.js': 'js',
            },
        }))
        .pipe(dest(jsConf.build))
}

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

/* ==========================================================================
   Watch 👀
   ========================================================================== */

function watching (done) {
    // Styling
    watch(
        [cssConf.src, cssConf.sub, cssConf.blocks],
        { events: 'all', ignoreInitial: false },
        series(lintStyles, devMainStyles, devBlockStyles)
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

exports.watch = parallel(server, cleanStyles, cleanScripts, devMainStyles, devBlockStyles, devScripts, watching);

/* ==========================================================================
   Production 🚀
   ========================================================================== */

exports.build = series(sprite, cleanStyles, cleanScripts, distMainStyles, distBlockStyles, distScripts);
