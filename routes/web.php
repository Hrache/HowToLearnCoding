<?php

/**
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 |--------------------------------------------------------------------------
 | contains the "web" middleware group. Now create something great!
 |
 */
Route::get('/{rank?}', 'PagesController@index')->where('rank', '[0-9]{1,2}')->name('website');
Route::get('/{rank?}/comments', 'CommentsController@index')->name('comments');
Route::resource('comments', 'CommentsController');
// Route::post('/comments/emailcheck', 'CommentsController@ajaxemailcheck')->name('comments.email');

Route::middleware('platform')->group(function() {

 // full cache reset except route:cache
 Route::get('/fullcachereset', function() {

  Artisan::call('cache:clear');
  Artisan::call('config:cache');
  Artisan::call('event:cache');
  Artisan::call('view:cache');

  Alert::info('Cache was cleared successfuly!');

  return redirect()->route('platform.main');
 });

 // full vendor update
 Route::get('/fullupdate', function() {

  /**
   * Fetches the laravel/framework package's version number
   *
   * @param string $inputText The text from which the version number should be fetched
   * @return int The integer representation of the laravel/framework version
   */
  function fetchLaravelVersionNumber(string $inputText): int {

   $match= [];
   preg_match('/\d+\.{1}\d+\.{1}\d+/', $inputText, $match);

   return intval(implode('', explode('.', $match[0])));
  }

  // Changing current directory to the base directory for terminal commands 
  chdir(base_path());

  $mLineText= shell_exec("composer show laravel/framework -l");
  $onlineVersion= [];

  preg_match( "/versions\ .+/", $mLineText, $onlineVersion);

  // Online laravel/framework version number
  $onlineVersion= fetchLaravelVersionNumber($onlineVersion[0]);

  // Local, installed laravel/framework version number
  $currentLaravelVersion= shell_exec("php artisan --version");

  $matches= [];
  preg_match_all('/\d+\.{1}\d+\.{1}\d+/', implode(' ', [$currentLaravelVersion, shell_exec('composer show laravel/framework | grep "versions"')]), $matches);

  $matches= $matches[0];
  array_walk($matches, function(&$v, $k) {

   $v= implode('', explode('.', $v));
  });

  $currentLaravelVersion= intval(max(...$matches));

  if ($onlineVersion > $currentLaravelVersion) {

   if (shell_exec('composer update')) {

    Alert::success('Your project is fully updated!');
   }
   else {

    Alert::error('We couldn\'t update your project!');
   }
  }
  else {

   Alert::info('No need to do update the project, you\'re already up to date!');
  }

  return redirect()->route('platform.main');
 });
});