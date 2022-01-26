/* jshint esversion: 6 */
const gulp = require("gulp");

const babel = require("gulp-babel");
const browserify = require("browserify");
const concat = require("gulp-concat");
const del = require("del");
const uglify = require("gulp-uglify");
const rename = require("gulp-rename");
const sass = require("gulp-sass")(require("node-sass"));
sass.compiler = require("node-sass");
const sourcemaps = require("gulp-sourcemaps");
// const source = require('vinyl-source-stream');
const buffer = require("vinyl-buffer");
const postCSS = require("gulp-postcss");

THEME_ROOT = process.cwd();

const ASSETS = {
  src: {
    css: "assets-src/css/",
    js: "assets-src/js/",
    admin: "assets-src/admin/",
    fonts: "assets-src/fonts/",
  },
  dest: {
    css: "assets/css/",
    js: "assets/js/",
    admin: "assets/admin/",
    fonts: "assets/fonts/",

    lib: "assets/js/npm-dists/",
    npm: "assets/npm/",
  },
};

const TEMPLATE_PATHS = [
  `${THEME_ROOT}/*.php`,
  `${THEME_ROOT}/templates/**/*.php`,
  `${THEME_ROOT}/woocommerce/**/*.php`,
  `${THEME_ROOT}/woocommerce-bookings/**/*.php`,
];

/*** Stylesheets ***/

const tailwind = () => {
  return gulp
    .src(ASSETS.src.css + "/tailwind.css")
    .pipe(postCSS([require("tailwindcss"), require("cssnano")]))
    .pipe(gulp.dest(ASSETS.dest.css));
};
const watchTemplates = () =>
  gulp.watch(TEMPLATE_PATHS, {}, gulp.series(tailwind));

const doPostCSS = () => {
  return gulp
    .src(ASSETS.src.css + "/*.+(scss)")
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postCSS()) // uses './postcss.config.js' if no options are passed
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(ASSETS.dest.css));
};

const watchStyles = () =>
  gulp.watch(ASSETS.src.css, {}, gulp.series(doPostCSS));

const doAdminPostCSS = () => {
  return gulp
    .src(ASSETS.src.admin + "**/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postCSS())
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(ASSETS.dest.admin));
};

const watchStylesAdmin = () =>
  gulp.watch(ASSETS.src.admin + "**/*.scss", {}, gulp.series(doAdminPostCSS));

/*** Javascript ***/
gulp.task("buildMainBundle", function() {
  return (
    browserify([ASSETS.src.js + "main.js"])
      .transform("babelify", {
        // global: true, // if uglify fails and causes errors: set this to true
        // sourceType: 'script',
        presets: [
          [
            "@babel/preset-env",
            {
              targets: "> 1.25%, ie 11, not dead",
              // "useBuiltIns": "entry",
              // "corejs": 3
            },
          ],
        ],
      })
      .bundle()
      .pipe(require("vinyl-source-stream")("main-bundle.min.js"))
      .pipe(buffer())
      // .pipe(uglify())
      .pipe(gulp.dest("./assets/js/"))
  );
});

const watchMainScripts = () =>
  gulp.watch(ASSETS.src.js + "*.js", {}, gulp.series("buildMainBundle"));

/**
 * Copies package dependencies (not devDeps)
 * from node_modules into assets/lib.
 * Concatenates all found files into {ASSETS.dest.lib}/npm-bundle.min.js
 */
const includeNpmDist = () => {
  const npmDist = require("gulp-npm-dist");
  return gulp
    .src(
      npmDist({
        excludes: ["*ie11.js"],
      }),
      {
        base: "./node_modules",
      }
    )
    .pipe(gulp.dest(ASSETS.dest.lib))
    .pipe(
      babel({
        presets: [
          [
            "@babel/preset-env",
            {
              loose: true,
              modules: false,
              targets: "> 0.25%, not dead",
            },
          ],
        ],
      })
    )
    .pipe(uglify())
    .pipe(concat("npm-bundle.min.js", { newLine: `;\r\n` }))
    .pipe(gulp.dest(ASSETS.dest.lib));
};

const buildSingleScripts = () => {
  return (
    gulp
      .src(
        [ASSETS.src.js + "/singles/*.js", "!*.min.*"]
        /* { base: 'src/js' } */
      )
      .pipe(sourcemaps.init())
      .pipe(
        babel({
          presets: [
            [
              "@babel/preset-env",
              {
                loose: true,
                modules: false,
                targets: "> 0.25%, not dead",
              },
            ],
          ],
        })
      )
      .pipe(gulp.dest(ASSETS.dest.js + "singles"))
      // .pipe(uglify())
      .pipe(rename((path) => (path.basename += ".min")))
      .pipe(gulp.dest(ASSETS.dest.js + "singles"))
      .pipe(sourcemaps.write("./sourcemaps", {}))
  );
};

const watchSingleScripts = () =>
  gulp.watch(
    [ASSETS.src.js + "singles/*.js"],
    {},
    gulp.series(buildSingleScripts)
  );

/*** Misc ***/

/* copy fonts */
const buildFonts = () => {
  return gulp.src(ASSETS.src.fonts + "**").pipe(gulp.dest(ASSETS.dest.fonts));
};

// Copies files to theme assets to be manually enqueued by wp
gulp.task("pluckNodeModules", function() {
  const files = [
    "di-date-range-picker/*.min.css",
    // 'di-date-range-picker/dist/*.js'
  ].map((f) => `node_modules/${f}`);

  return gulp.src(files).pipe(
    gulp.dest(function(file) {
      let packageName = /(?:node_modules\/)([^\/]+?)\//.exec(file.path)[1];

      return ASSETS.dest.npm + packageName;
    })
  );
});

const cleanAssets = () =>
  del([
    ASSETS.dest.js,
    ASSETS.dest.css,
    ASSETS.dest.lib,
    ASSETS.dest.fonts,
    ASSETS.dest.admin,
  ]);

/*** Tasks ***/

gulp.task(tailwind);
gulp.task("scripts", gulp.series("buildMainBundle", buildSingleScripts));
gulp.task("doSingleBabel", gulp.series(buildSingleScripts));
gulp.task("styles", gulp.series(doPostCSS, tailwind));
gulp.task("fonts", gulp.series(buildFonts));
gulp.task("admin-styles", gulp.series(doAdminPostCSS));

gulp.task("build", gulp.parallel("scripts", "styles"));
gulp.task("build:admin", gulp.parallel("admin-styles"));
gulp.task(
  "build:all",
  gulp.parallel("scripts", "styles", "fonts", "build:admin", "pluckNodeModules")
);

gulp.task("rebuild", gulp.series(cleanAssets, "build:all"));

gulp.task("watch:scripts", gulp.parallel(watchMainScripts, watchSingleScripts));
gulp.task("watch:styles", gulp.parallel(watchStyles, watchTemplates));
gulp.task("watch:admin", gulp.parallel(watchStylesAdmin));

gulp.task(
  "watch",
  gulp.parallel("watch:scripts", "watch:styles", "watch:admin")
);

gulp.task("default", gulp.series("build", "watch"));
