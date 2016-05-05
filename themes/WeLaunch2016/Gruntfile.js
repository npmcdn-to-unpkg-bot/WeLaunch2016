module.exports = function (grunt) {
    var styleguide = require('devbridge-styleguide');
    grunt.registerTask('start-styleguide', function () {
        var done = this.async();
        styleguide.startServer().then(function (instance) {
            instance.on('close', done);
        });
    });
}