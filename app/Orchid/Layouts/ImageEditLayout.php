<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;

use App\Images;
use App\Websites;

class ImageEditLayout extends Rows {

  public $data = 'image';

  /**
   * Views.
   *
   * @return Field[]
   */
  protected function fields(): array {

   return [
    Input::group([
     Select::make('image.role')
      ->fromModel(Images::class, 'role')
      ->title('Role')
      ->help('Choose the image role')
      ->required()
      ->options([
        'cover' => 'cover',
        'intro' => 'intro',
        'body' => 'body',
        'last' => 'last'
      ]),

     Relation::make('image.website_id')
      ->required()
      ->fromModel(Websites::class, 'title', 'id')
      ->title('Website')
      ->help('The website'),
    ]),

    Cropper::make('image.image')
     ->required()
     ->title('Add an image')
     ->width(851)
     ->height(315),
   ];
 }
}