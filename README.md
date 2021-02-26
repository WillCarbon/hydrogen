# Project name

Project name is a Wordpress website. Possibly a short description of the website and its features.

The website is built with:

* [Wordpress](https://wordpress.com/) 
* [Carbonara](https://github.com/carboncreativeuk/Carbonara) - Base Theme
* [Carbon Neutral](https://github.com/carboncreativeuk/CarbonNeutral) - Helper Plugin

### System Requirements

* [PHP](https://www.php.net/) v7.4
* [Composer](https://getcomposer.org/)
* [Node](https://nodejs.org/en/) v14
* [NPM](https://www.npmjs.com/) 
* [Gulp](https://gulpjs.com/)


### Installation

1. Clone the project from Github: `git clone <github url> themename`
2. Install the dependencies: `npm install && npm run deploy`
3. Set up a database and update the connection details in wp-config.php
4. Set up a Valet instance, so the site can be accessed at: http://themename.localhost


### Deployment Scripts

* `npm run deploy` Runs _composer install_ and _gulp build_
* `npm run watch` Runs _gulp watch_
* `npm run build` Runs _gulp build_
* `npm run update` Runs _git pull_ and _gulp build_


### Available Gulp Tasks

* _styling_ - Compile CSS files
* _scripting_ - Compile JavaScript files
* _vendor_ - Copy Vendor files to theme
* _watch_ - Watch for changes, Local only
* _version_ - Create theme version number
* _build_ - Compile all files


### Developer Tips

* [Any developer tips to go here](docs/example.md)


### Credits

* [Name](https://github.com/name)
