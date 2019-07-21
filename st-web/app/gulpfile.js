var gulp = require("gulp");
var del = require("del");

gulp.task("cleanWeb", function(cb) {
    del(["../../xampp/htdocs/st-web"], { force: true });
    console.log("finished web clean");
    cb();
});

gulp.task("cleanApi", function(cb) {
    del(["../../xampp/htdocs/api"], { force: true });
    console.log("finished api clean");
    cb();
});

gulp.task("clean", gulp.series("cleanWeb", "cleanApi"), function(cb) {
    del(["dist/**/*"], { force: true });
    console.log("finished full clean");
    cb();
});

gulp.task("deployWeb", function(cb) {
    gulp.src(["dist/**/*"]).pipe(gulp.dest("../../xampp/htdocs"));
    console.log("copied web dist to htdocs");
    cb();
});

gulp.task("deployApi", function(cb) {
    gulp.src(["../../api/**/*"]).pipe(gulp.dest("../../xampp/htdocs/api"));
    console.log("copied api to htdocs");
    cb();
});

gulp.task("deploy", gulp.series("deployWeb", "deployApi"), function(cb) {
    console.log("finished full deploy");
    cb();
});

function defaultTask(cb) {
    cb();
}

exports.default = defaultTask;
