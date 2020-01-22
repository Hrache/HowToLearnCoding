<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

use App\Websites;

class WebsitesListLayout extends Table
{
  /**
   * Data source.
   *
   * @var string
   */
  protected $target = 'websites';

  /**
   * @return TD[]
   */
  protected function columns(): array
  {
    return [
      TD::set('rank', 'Rank')
        ->sort(true),
      TD::set('title', 'Title')
        ->sort()
          ->render(function (Websites $website) {
            return "<strong>{$website->title}</strong>";
          }),
      TD::set('external_url', 'Real Address')
        ->sort()
          ->render(function (Websites $website) {
            return "<a href='{$website->external_url}' target='_blank' class='text-link text-hover'>{$website->external_url}</a>";
          }),
      // TD::set('created_at', 'Created')->sort(),
      TD::set('updated_at', 'Last edit')
        ->sort(),
      TD::set('', 'Actions')
        ->render(function (Websites $website) {
          $route = route('platform.website.edit', $website);
          return "<a title='Edit' href='{$route}'><i class='icon-brush btn btn-warning'></i></a>";
        }),
      TD::set('id', 'ID')
        ->sort()
    ];
  }
}
