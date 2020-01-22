<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

use App\Comments;
use App\Websites;

class CommentsListLayout extends Table
{
  /**
   * Data source.
   *
   * @var string
   */
  protected $target = 'comments';

  /**
   * @return TD[]
   */
  protected function columns(): array
  {
    return [
      TD::set('id', 'ID')->sort(),
      TD::set('author', 'Author')->sort(),
      TD::set('email', 'Email')->sort(),
      TD::set('website_id', 'Website')->sort()
        ->render(function (Comments $comment)
        {
          $website = Websites::where('id', $comment->website_id)->first();
          $route = route('platform.website.edit', ['website' => $website]);
          return "<a style='writing-mode: vertical-lr;' title='Edit' href='{$route}'>{$website->title}</a>";
        }),
      TD::set('created_at', 'Created')->sort()
        ->render(function(Comments $comment) {

          $website = Websites::where('id', $comment->website_id)->first();
          return "<span style='writing-mode: vertical-lr;'>{$website->created_at}</span>";

        }),
      TD::set('updated_at', 'Last edit')->sort()
        ->render(function(Comments $comment) {

          $website = Websites::where('id', $comment->website_id)->first();
          return "<span style='writing-mode: vertical-lr;'>{$website->updated_at}</span>";

        }),
      TD::set('', 'Actions')
        ->render(function (Comments $comment) {

          $route = route('platform.comment.edit', ['comment' => $comment]);
          return "<a title='Edit' href='{$route}'><i class='icon-brush btn btn-warning'></i></a>";

        })
    ];
  }
}
