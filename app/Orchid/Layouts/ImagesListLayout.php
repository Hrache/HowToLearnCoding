<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Support\Facades\Storage;

use App\Images;
use App\Websites;

class ImagesListLayout extends Table {

  /**
   * Data source.
   *
   * @var string
   */
  protected $target = 'images';

  /**
   * @return TD[]
   */
  protected function columns(): array {

    return [

     TD::set('id', 'Id')->sort()
      ->width(70)
      ->render(function(Images $image) {

       return "<span dir='ltr' title='{$image->id}'>{$image->id}</span>";
      }),

     TD::set('role', 'Image role')->sort()
      ->render(function(Images $image) {

       return "<span dir='ltr' style='writing-mode: vertical-rl;' title='{$image->role}'>{$image->role}</span>";
      }),

     TD::set('image', 'Image')->sort()
      ->render(function(Images $image) {

       return "<img src='{$image->image}' class='img-thumbnail' style='cursor: pointer;' />";
      }),

     TD::set('website_id', 'Website')->sort()
      ->render(function(Images $image) {

       $websiteTitle = Websites::where('id', $image->website_id)->first()->title;

       return "<strong style='writing-mode: vertical-rl;' title='{$websiteTitle}'>{$websiteTitle}</strong>";
      }),

     TD::set('created_at', 'Created')->sort()
      ->render(function(Images $image) {

       return "<span dir='ltr' style='writing-mode: vertical-rl;' title='{$image->created_at}'>{$image->created_at}</span>";
      }),

     TD::set('', 'Actions')
      ->render(function (Images $image) {

       $route = route('platform.image.edit', ['image' => $image]);

       return "<a title='Edit' href='{$route}'><i class='icon-brush btn btn-warning'></i></a>";
      })
    ];
  }
}