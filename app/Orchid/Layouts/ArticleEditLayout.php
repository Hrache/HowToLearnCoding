<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
// use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

use App\Websites;
use App\Articles;

class ArticleEditLayout extends Rows
{
    /**
   * Data source.
   *
   * @var string
   */
  protected $target = 'article';

  /**
   * Views.
   *
   * @return Field[]
   */
  protected function fields(): array {

   return [

    Input::group([

     Relation::make('article.website_id')
      ->required()
      ->fromModel(Websites::class, 'title', 'id')
      ->title('Website'),

     Select::make('article.role')
      ->fromModel(Articles::class, 'role')
      ->title('Role')
      ->help('Choose the image role')
      ->required()
      ->options([
       'intro' => 'intro',
       'body' => 'body',
       'last' => 'last',
       'extra' => 'extra'
      ]),
    ]),

    Input::make('article.title')
     ->type('text')
     ->max(255)
     ->required()
     ->title('Title')
     ->help('The title for the article'),

   TextArea::make('article.article')
    ->set('id', 'summernotemarkdown')
    ->help('The article text')
    ->required()
    ->title('Content')

/*
    SimpleMDE::make('article.article')
     ->help('The article text')
     ->required()
     ->title('The content of the article')
*/

  ];
 }
}