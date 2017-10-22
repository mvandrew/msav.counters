var gulp                = require("gulp"),
    del                 = require('del'),
    runSequence         = require('run-sequence'),
    convertEncoding     = require('gulp-convert-encoding'),
    zip                 = require('gulp-zip');

var build_dir = '_build';

var build_files = [
    '**',
    '!' + build_dir,
    '!' + build_dir + '/**',
    '!node_modules',
    '!node_modules/**',
    '!.git',
    '!.git/**',
    '!package.json',
    '!package-lock.json',
    '!**/*.arj',
    '!**/*.rar',
    '!**/*.zip',
    '!.gitignore',
    '!gulpfile.js',
    '!LICENSE',
    '!README.md'
];


//
// Предварительная очистка каталога сборки
//
gulp.task( 'build-clean', function() {
    return del.sync( build_dir );
});


//
// Копирование файлов сборки
//
gulp.task( 'build-copy', function() {
    return gulp.src( build_files )
        .pipe( gulp.dest( build_dir + '/utf8' ) );
} );


//
// Изменение кодировки решения в win-1251 для загрузки в Marketplace 1C-Bitrix
//
gulp.task( 'build-encode', function () {
    return gulp.src( build_dir + '/utf8/**' )
        .pipe( convertEncoding({to: 'win-1251'}) )
        .pipe( gulp.dest( build_dir + '/win1251') );
});


gulp.task( 'build-zip', function () {
   // Получение данных из файла пакета
   var fs = require('fs');
   var json = JSON.parse(fs.readFileSync("./package.json"));

   var packageName = json.name + '.' + json.version;
   var authorId = 'msavru.';

   var resUtf8 = gulp.src( build_dir + '/utf8/**' )
       .pipe( zip(authorId + packageName + '.utf8.zip') )
       .pipe( gulp.dest(build_dir + '/dest') );

   var resWin = gulp.src( build_dir + '/win1251/**' )
       .pipe( zip(authorId + packageName + '.zip') )
       .pipe( gulp.dest(build_dir + '/dest') );

   return resUtf8 && resWin;
});


//
// Запуск процесса сборки пакета
//
gulp.task( 'build', function() {
    return runSequence( 'build-clean', 'build-copy', 'build-encode', 'build-zip' );
} );
