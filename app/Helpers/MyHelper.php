<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Route;

class MyHelper {

  /**
   * $detail: 'id', 'image', 'label', 'website_id', 'created_at', 'updated_at'
   */
  static public function f_image(string $detail = 'image', Object &$image = null, string $dummyimg = 'images/dummyimg.jpg') {

    $detail = strtolower($detail);
    if (!$image || !isset($image->{$detail}) || !in_array($detail, ['id', 'image', 'label', 'website_id', 'created_at', 'updated_at'])) return '';
    if ($image->{$detail}) return $image->{$detail};
    if ((!$image->{$detail} && $detail === 'image') || $detail === 'dummy') return $dummyimg;
  }

  /**
   * @param string $role 'intro', 'body', 'last', 'extra'
   * @param Object $articles The object that contains articles for a certain website
   */
  static public function article(Collection $articles, string $role = 'intro', string $property = '') {

   $role = strtolower($role);
   if (!in_array($role, ['intro', 'body', 'last', 'extra'])) {

    return '';
   }

   foreach ($articles as $article) {

    if ($role === 'extra' && $article->role === 'extra') {

     return true;
    }

    if ($article && isset($article->{$property}) && ($article->role === $role)) {

     return $article->{$property};
    }
   }
  }

  /**
   * Replaces \ with / and opposite / with \ in any string
   * @param string $input The input text
   * @param bool $back If true than slash into backslash (/ -> \\)
   * @return string
   */
  static public function invertSlashes(string $input, bool $back = false): string {

   return ($back)? str_replace('/', '\\', $input): str_replace('\\', '/', $input);
  }

  /**
   * Returns the name of precious route
   */
  static public function previousRoute(): Route {

   return app('router')->getRoutes()->match(app('request')->create(url()->previous() || url()->current()));
  }
  
 /**
  * 
  * @param string $role
  * @param Collection $ofRole
  * @return bool
  */
 static public function uniqueRole(string $role, Collection $ofRole): bool {

  return $ofRole->where('role', $role)->get();
 }

 /**
  * Generates breadcrumb for the current request
  */
 static public function breadcrumb() {}
}