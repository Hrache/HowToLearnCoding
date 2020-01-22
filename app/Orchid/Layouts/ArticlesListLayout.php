<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

use App\Articles;
use App\Websites;

class ArticlesListLayout extends Table
{
  /**
   * Data source.
   *
   * @var string
   */
  protected $target = 'articles';

  /**
   * @return TD[]
   */
  protected function columns(): array
  {
    return [
      TD::set('id', 'ID')->sort(),
      TD::set('title', 'Title')->sort()->width(192),
      TD::set('website_id', 'Website')->sort()
       ->render(function (Articles $article) {

         $route = route('platform.article.edit', ['article' => $article]);
         $website_title = Websites::where('id', $article->website_id)->firstOrFail()->title;
         return "<a style='writing-mode: vertical-rl;' href='{$route}'>{$website_title}</a>";

       }),
      TD::set('role', 'Role')->sort()
       ->render (function (Articles $article) {

        return "<span style='writing-mode: vertical-rl;'>".$article->role."</a>";

       }),
      TD::set('updated_at', 'Last edit')->sort()
       ->render (function (Articles $article) {

        return "<span style='writing-mode: vertical-rl;'>".$article->updated_at."</a>";

       }),
      TD::set('', 'Actions')
       ->render (function (Articles $article) {

        $route = route('platform.article.edit', ['article' => $article]);
        return "<a title='Edit' href='{$route}'><i class='icon-brush btn btn-warning'></i></a>";

       })
    ];
  }
}
