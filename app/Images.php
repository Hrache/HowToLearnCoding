<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Images extends Model {

 use AsSource, Attachable, Filterable;

 protected $table = 'images';
 protected $fillable = [
  'role', 'image', 'website_id'
 ];
 protected $allowedSorts = [
  'id', 'image', 'role', 'website_id', 'updated_at'
 ];

 /**
  * Replace backslashes with slashes
  *
  * @param  string $value
  * @return void
  */

 public function setImageAttribute($value) {

  $this->attributes['image'] = str_replace('\\', '/', $value);

 }
}