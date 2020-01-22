<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Comments extends Model {

 use AsSource, Attachable, Filterable;

 protected $table = 'comments';

 protected $fillable = [
  'author', 'email', 'content', 'website_id'
 ];

 protected $allowedSorts = [
  'id', 'author', 'email', 'website', 'website_id', 'created_at', 'updated_at'
 ];
}