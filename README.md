# Project name

Project name is a Wordpress website. Possibly a short description of the website and its features.

The website is built with:

* [Wordpress](https://wordpress.com/) 
* [Carbonara](https://github.com/carboncreativeuk/Carbonara) - Base Theme
* [Carbon Neutral](https://github.com/carboncreativeuk/CarbonNeutral) - Helper Plugin

### System Requirements

* [Composer](https://getcomposer.org/)
* [NPM](https://www.npmjs.com/) 
* [Node](https://nodejs.org/en/)
* [Gulp](https://gulpjs.com/)

### Installation

1. Clone the project from Github: `git clone <github url> projectname`
2. Install the dependencies: `npm install && npm run deploy`
3. Set up a database and update the connection details in wp-config.php
4. Set up an Valet so the site can be accessed at: http://projectname.localhost

### Deployment Scripts

* `npm run deploy` Runs _composer install_ and _gulp build_
* `npm run watch` Runs _gulp watch_
* `npm run build` Runs _gulp build_
* `npm run update` Runs _git pull_ and _gulp build_

### Developer Tips

* [Any developer tips to go here]()
* [Put any files created in a `readme` folder]()

### Credits

* [Name](https://github.com/name)
