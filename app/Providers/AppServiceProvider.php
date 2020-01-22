<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Websites;

class AppServiceProvider extends ServiceProvider {

 /**
  * Register any application services.
  *
  * @return void
  */
 public function register() {
  //
 }

 /**
  * Bootstrap any application services.
  *
  * @return void
  */
 public function boot() {

  /**
   * @var stdClass $page
   */
  $page = new \stdClass();
  $page->title = str_replace('_', ' ', env('APP_NAME'));
  View::share('page', $page);

  // Data for the menu elements
  View::share('topMenuWebsites', Websites::all('rank', 'external_url', 'title'));
 }
}