import gulp, {watch} from 'gulp'; // Gulp + Watch-Funktion
import concat from 'gulp-concat'; // Dateien zusammenführen
import uglify from 'gulp-terser'; // JavaScript minifizieren
import imagemin from 'gulp-imagemin'; // Bilder optimieren
import imageminGifsicle from 'imagemin-gifsicle'; // GIF-Optimierung
import imageminMozjpeg from 'imagemin-mozjpeg'; // JPG-Optimierung
import imageminOptipng from 'imagemin-optipng'; // PNG-Optimierung
import imageminSvgo from 'imagemin-svgo'; // SVG-Optimierung
import changed from 'gulp-changed'; // Nur geänderte Dateien verarbeiten
import rename from 'gulp-rename'; // Dateien umbenennen
import merge from 'merge-stream'; // Mehrere Streams zusammenführen
import * as dartSass from 'sass'; // Sass Compiler
import gulpSass from 'gulp-sass'; // Sass für Gulp
const sass = gulpSass(dartSass);
import cssmin from 'gulp-clean-css'; // CSS minifizieren

// Projektpfade zentral definiert

let config = {
    defaultConfigDir: './resources/bootstrap',
    defaultCustomDir: './resources/custom',
    defaultJqueryDir: './resources/jquery',
    publicDir: './public'
};
// =====================
// CSS
// =====================
export function css() {
    // Unkomprimierte CSS-Datei erstellen
    const unkomprimiert = gulp.src([
        config.defaultCustomDir + '/scss/bootstrap/app.scss',
        config.defaultCustomDir + '/css/**/*.scss',
        config.defaultCustomDir + '/css/**/*.css'

    ])
        .pipe(sass.sync().on('error', sass.logError)) // SCSS → CSS kompilieren
        .pipe(concat('app.css')) // Alle Dateien zusammenführen
        .pipe(gulp.dest(config.publicDir + '/css')); // Ausgabe speichern
    // Minifizierte CSS-Datei erstellen (.min.css)
    const komprimiert = gulp.src([
        config.defaultCustomDir + '/scss/bootstrap/app.scss',
        config.defaultCustomDir + '/css/**/*.scss',
        config.defaultCustomDir + '/css/**/*.css'
    ])
        .pipe(sass.sync().on('error', sass.logError)) // SCSS → CSS
        .pipe(concat('app.css')) // Zusammenführen
        .pipe(cssmin()) // CSS komprimieren
        .pipe(rename({suffix: '.min'})) // Dateiname: app.min.css
        .pipe(gulp.dest(config.publicDir + '/css'));

    // Beide Streams zusammen zurückgeben (wichtig für Gulp!)
    return merge(unkomprimiert, komprimiert);
}



// =====================
// Fonts
// =====================
export function fonts() {
    return gulp.src(config.defaultCustomDir + '/fonts/**/*', { encoding: false }) // alle Fonts laden
        .pipe(gulp.dest(config.publicDir + '/fonts')); // in public kopieren
}

// ====================
// Plugins
// =====================
export function plugins() {
    return gulp.src(config.defaultCustomDir + '/plugins/**/*', { encoding: false }) // Plugin-Dateien
        .pipe(gulp.dest(config.publicDir + '/plugins')); // kopieren
}

// =====================
// JS
// =====================
export function js() {
    return gulp.src([//Befehl laden alles aus dem Ordner
        config.defaultJqueryDir + '/jquery.min.js',
        config.defaultJqueryDir + '/jquery.session.js',
        config.defaultConfigDir + '/js/bootstrap.bundle.min.js',
        config.defaultConfigDir + '/js/bootstrap-filestyle.min.js',
        config.defaultCustomDir + '/js/**/*.js',
    ])
        .pipe(concat('app.min.js')) // alle JS-Dateien bündeln
        .pipe(uglify()) // JS minifizieren
        .pipe(gulp.dest(config.publicDir + '/js')); // speichern
}

// =====================
// Images
// =====================
export function images() {
    return gulp.src(config.defaultCustomDir + '/images/**/*', { encoding: false })
        .pipe(changed(config.publicDir + '/images')) // nur neue/geänderte Bilder
        .pipe(imagemin([
            imageminGifsicle({ interlaced: true }), // GIF
            imageminMozjpeg({ quality: 40, progressive: false }), // JPG (starke Kompression!)
            imageminOptipng({ optimizationLevel: 5 }), // PNG
            imageminSvgo({
                plugins: [
                    {
                        name: 'preset-default' // Standard-Optimierungen
                    },
                    {
                        name: 'removeViewBox',
                        active: false // wichtig: SVG bleibt responsive
                    }
                ]
            })
        ]))
        .pipe(gulp.dest(config.publicDir + '/images')); // speichern
}


// =====================
// Watch (Dateien beobachten)
// =====================
export function watchFiles() {

    // JS Änderungen
    gulp.watch(config.defaultCustomDir + '/js/**/*.js', js);

    // CSS / SCSS Änderungen
    gulp.watch(config.defaultCustomDir + '/css/**/*.css', css);
    gulp.watch(config.defaultCustomDir + '/scss/**/*.scss', css);

    // Bilder
    gulp.watch(config.defaultCustomDir + '/images/**/*', images);

    // Fonts
    gulp.watch(config.defaultCustomDir + '/fonts/**/*', fonts); // Plugins
    gulp.watch(config.defaultCustomDir + '/plugins/**/*', plugins);
}


// =====================
// Haupt-Tasks
// =====================

// Alle Tasks parallel ausführen (Build)
const build = gulp.parallel(css, js, images, fonts, plugins);

// Standard-Task (wird bei "gulp" ausgeführt)
export default build;