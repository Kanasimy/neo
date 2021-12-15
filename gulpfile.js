const gulp = require("gulp");
const plumber = require("gulp-plumber");
const sourcemap = require("gulp-sourcemaps");
const sass = require("gulp-sass");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const sync = require("browser-sync").create();
const htmlmin = require("gulp-htmlmin");
const csso = require("gulp-csso");
const rename = require("gulp-rename");
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const svgstore = require("gulp-svgstore");
const del = require("del");
//todo вроде плагин к postcss умеет
const modifyCssUrls = require('gulp-modify-css-urls');

const patchLocal = 'local/templates/neodent/';


// Styles

const styles = () => {
  return gulp.src("source/sass/style.scss")
    .pipe(plumber())
    .pipe(sourcemap.init())
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(csso())
    .pipe(rename("style.min.css"))
    .pipe(sourcemap.write("."))
    .pipe(gulp.dest("build/css"))
    .pipe(sync.stream());
}

exports.styles = styles;

const stylesLocal = () => {
  return gulp.src("source/sass/style.scss")
    .pipe(plumber()).pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(csso())
    .pipe(rename("template_styles.css"))
    .pipe(modifyCssUrls({
      modify: function (url) {
        url = url.replace(/..\/img/g,"img");
        url = url.replace(/..\/fonts/g,"./fonts");
        return url;
      }
    }))
    .pipe(gulp.dest(patchLocal))
    .pipe(sync.stream());
}


exports.stylesLocal = stylesLocal;

// HTML

const html = () => {
  return gulp.src("source/*.html")
    .pipe(htmlmin({ collapseWhitespace: true }))
    .pipe(gulp.dest("build"))
    .pipe(sync.stream());
}

exports.html = html;

//JS

const scripts = () => {
  return gulp.src("source/js/script.js")
    //.pipe(terser())
    .pipe(rename("script.min.js"))
    .pipe(gulp.dest("build/js"))
    .pipe(sync.stream());
}

exports.scripts = scripts;

//Images

const optimizeImages = () => {
  return gulp.src("source/img/**/*.{jpg,png,svg}")
    .pipe(imagemin([
      imagemin.mozjpeg({quality: 75, progressive: true}),
      imagemin.optipng({optimizationLevel: 3}),
      imagemin.svgo()
    ]))
    .pipe(gulp.dest("build/img"))
    .pipe(gulp.dest(patchLocal + "/img"))
}

exports.optimizeImages = optimizeImages;

const copyImages = () => {
  return gulp.src("source/img/**/*.{png,jpg,svg}")
    .pipe(gulp.dest("build/img"))
    .pipe(gulp.dest(patchLocal + "/img"))
}

exports.copyImages = copyImages;

//WebP

const createWebp = () => {
  return gulp.src("source/img/**/*.{jpg,png}")
    .pipe(webp({quality: 90}))
    .pipe(gulp.dest("build/img"))
    .pipe(gulp.dest(patchLocal + "/img"))
}

exports.createWebp = createWebp;

//Sprite

const sprite = () => {
  return gulp.src("source/img/interactive.elements/*.svg")
    .pipe(svgstore({
      inlineSvg: true
    }))
    .pipe(rename("sprite.svg"))
    .pipe(gulp.dest(patchLocal + "/img"))
    .pipe(gulp.dest("build/img"));
}

exports.sprite = sprite;

// Copy

const copy = (done) => {
  gulp.src([
    "source/fonts/*.{woff2,woff}",
    "source/js/**/*",
    "source/*.html",
    "source/*.ico",
  ], {
    base: "source"
  })
    .pipe(gulp.dest("build"))
    done();
}

exports.copy = copy;

const copyLocal = (done) => {
  gulp.src([
    "source/fonts/*.{woff2,woff}",
    "source/js/**/*",
  ], {
    base: "source"
  })
    .pipe(gulp.dest(patchLocal))
  done();
}

exports.copy = copyLocal;

//Clean

const clean = () => {
  return del([
    "build",
    patchLocal + "/fonts",
    patchLocal + "/img",
    patchLocal + "/template_styles.css",
    patchLocal + "/template_styles.css.map"
  ]);

};

exports.clean = clean;


//Reload

const reload = (done) => {
  sync.reload();
  done();
}

//Build

const build = gulp.series(
  clean,
  copy,
  copyLocal,
  optimizeImages,
  styles,
  stylesLocal,
  gulp.parallel(
    sprite,
    html,
    scripts,
    createWebp
  ),
);

exports.build = build;


// Server

const server = (done) => {
  sync.init({
    server: {
      baseDir: 'build'
    },
    cors: true,
    notify: false,
    ui: false,
  });
  done();
}

exports.server = server;

// Watcher

const watcher = () => {
  gulp.watch("source/sass/**/*.scss", gulp.series(
    styles,
    stylesLocal
  ));
  gulp.watch("source/*.html").on("change", sync.reload);
}

exports.default = gulp.series(
  styles, server, watcher
);


//Default

exports.default = gulp.series(
  clean,
  copy,
  copyLocal,
  copyImages,
  styles,
  stylesLocal,
  gulp.parallel(
    sprite,
    html,
    scripts,
    createWebp
  ),
  gulp.series(
    server,
    watcher
));
