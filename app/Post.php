<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;


class Post extends Model {

 use AsSource, Attachable;

 /**
  * @var array
  */
 protected $fillable = [
  'title', 'description', 'body', 'author'
 ];
}
