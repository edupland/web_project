var gulp = require('gulp'),
        watch = require('gulp-watch'),
        runSequence = require('run-sequence'),
        fs = require('fs'),
        browserify = require("browserify"),
        babelify = require("babelify"),
        uglify = require("gulp-uglify"),
        source = require('vinyl-source-stream');

var paths = {
    pages: ['public/*.html', 'public/**/*.html']
};

/*gulp.task('copyHtml', function () {
    return gulp.src(paths.pages)
        .pipe(gulp.dest('.'));
});*/


gulp.task('browserify', function () {
    return browserify({debug: true})
            .transform(babelify)
            .require("./public/scripts/app/app.js", {entry: true})
            .bundle()
            .on("error", function (err) {
                console.log("Error: " + err.message);
            })
            .pipe(fs.createWriteStream("./public/scripts/bundle.js"));
});

gulp.task("minify", function () {
    return gulp.src("./public/scripts/bundle.js")
            .pipe(uglify())
            .on("error", function (err) {
                console.log("Error: " + err.message);
            })
            .pipe(gulp.dest("./public/scripts"));
});

gulp.task("watch", function () {
    // Watch our scripts
    gulp.watch(["./public/script/**.js"], [
        "browserify"
    ]);

});

gulp.task('defaultDev', function () {
    return runSequence("browserify");
});

gulp.task('default', function () {
    return runSequence("browserify", "minify");
});
