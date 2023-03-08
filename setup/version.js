const fs = require('fs-extra');
const path = require('path');
const cwd = path.resolve();
const gitRevision = require('git-revision');

/*
    Creates/updates the web/version.php file with the latest git commit hash
*/
function createVersion() {
    fs.writeFile(`${cwd}/web/version.php`, '<?php define("SITE_VERSION", "' + gitRevision('tag') + '");', function() {});
}

module.exports.init = createVersion();