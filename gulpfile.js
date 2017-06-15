const gulp = require("gulp");
const sass = require("gulp-sass");
const browserSync = require("browser-sync").create();
const reload = browserSync.reload;

const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");

gulp.task("reload-js", () => {
  reload();
});

gulp.task("sass", () => {
  const options = {
    outputStyle: "compressed"
  };

  return gulp.src("./sass/*.scss")
    .pipe(sass(options).on("error", sass.logError))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(gulp.dest("./css"))
    .pipe(browserSync.stream());
});

gulp.task("serve", ["sass"], () => {
  browserSync.init({
    server: "./",
    open: false
  });

  gulp.watch("./js/*.js", ["reload-js"]);
  gulp.watch("./sass/*.scss", ["sass"]);
  gulp.watch("./*.html").on("change", reload);
});

gulp.task("default", ["serve"]);
