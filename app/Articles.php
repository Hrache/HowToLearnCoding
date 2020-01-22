<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use \Orchid\Filters\Filterable;

class Articles extends Model {

  use AsSource, Attachable, Filterable;

  protected $table = 'articles';
  protected $fillable = ['role', 'title', 'article', 'website_id'];
  protected $allowedSorts = ['id', 'title', 'role', 'website_id', 'updated_at'];

}