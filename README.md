# Project Name

Project Name is a WordPress website.

The website is built with:

* [WordPress](https://wordpress.com/) and Gutenberg
* [Hydrogen](https://github.com/carboncreativeuk/Hydrogen) - Base Theme
* [Carbon Neutral](https://github.com/carboncreativeuk/CarbonNeutral) - Carbon Helper Plugin
* [Carbonberg](https://github.com/carboncreativeuk/Carbonberg) - Carbon Default Blocks

### System Requirements

* [PHP](https://www.php.net/) v8.2
* [Composer](https://getcomposer.org/)
* [Node](https://nodejs.org/en/) v20
* [NPM](https://www.npmjs.com/) 
* [Gulp](https://gulpjs.com/)


### Installation

1. Clone the project from GitHub: `git clone <github url> themename`
2. Install the dependencies: `npm install && npm run deploy`
3. Set up a database and update the connection details in wp-config.php
4. Set up a Valet instance, so the site can be accessed at: http://themename.localhost


### Deployment Scripts

* `npm run deploy` Runs _composer install_ and _gulp build_
* `npm run watch` Runs _gulp watch_
* `npm run build` Runs _gulp build_
* `npm run update` Runs _git pull_ and _gulp build_
* `npm run version` Runs _node setup/version.js init_


#### Additional Language Scripts

For more about languages, please see the [wiki article here](#).

* `npm run lang-make-pot` Runs _wp i18n make-pot ..._
* `npm run lang-update-po` Runs _wp i18n update-po ..._
* `npm run lang-make-mo` Runs _wp i18n make-mo ..._


### Available Gulp Tasks

* _styling_ - Compile CSS files
* _scripting_ - Compile JavaScript files
* _sprite_ - Regenerate the SVG Sprite files
* _watch_ - Watch for changes, Local only
* _build_ - Compile all files


### Developer Tips

* [Any developer tips to go here](docs/example.md)


### Credits

* [Name](https://github.com/name)
