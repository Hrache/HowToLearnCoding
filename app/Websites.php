<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Websites extends Model {

 use AsSource, Attachable, Filterable;

 protected $table = 'websites';

 protected $fillable = [
  'title', 'external_url', 'rank'
 ];

 /**
  * @var
  */
 protected $allowedSorts = [
  'id', 'rank', 'title', 'external_url', 'updated_at'
 ];
}