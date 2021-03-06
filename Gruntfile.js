module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },

      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }        
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      }
    },

 uncss: {
  dist: {
    files: {
      'new/tidy.css': ['index.html', 'blog.html', 'euler.html', 'projects.html', 'resume.html', 'thanks.html']
	    }
	  }
	},

processhtml: {
  dist: {
    files: {
      'new/index.html': ['index.html'],
      'new/blog.html': ['blog.html'],
      'new/euler.html': ['euler.html'],
      'new/paint.html': ['paint.html'],
      'new/projects.html': ['projects.html'],
      'new/resume.html': ['resume.html'],
      'new/sketch.html': ['sketch.html'],
      'new/thanks.html': ['thanks.html'],
      'new/theme.html': ['theme.html']
    }
  }
}

  });


  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['build','watch']);
 
  grunt.loadNpmTasks('grunt-uncss');
}
