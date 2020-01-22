<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
// use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;
use Illuminate\Http\Request;

use App\Comments;
use App\Websites;

class CommentEditLayout extends Rows
{
 /**
  * Data source.
  *
  * @var string
  */
 protected $target = 'comment';

 /**
  * Views.
  *
  * @return Field[]
  */
 protected function fields(): array {

  return [
   Field::group([

    Input::make('comment.author')
     ->type('text')
     ->title('Author')
     ->max(191)
     ->required()
     ->help('Type the name of the author')
     ->placeholder('Author'),

    Input::make('comment.email')
     ->type('email')
     ->max(255)
     ->required()
     ->title('E-mail')
     ->placeholder('E-mail')
     ->help('The email of the author'),

    Relation::make('comment.website_id')
     ->required()
     ->fromModel(Websites::class, 'title', 'id')
     ->title('Website')

   ]),

   TextArea::make('comment.content')
    ->set('id', 'summernotemarkdown')
    ->help('The text of the comment')
    ->required()
    ->title('Content')

/*
   SimpleMDE::make('comment.content')
    ->help('The text of the comment')
    ->title('Content')
    ->required()
    ->placeholder("Comment's content")
*/
  ];
 }
}