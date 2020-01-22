<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

use App\Orchid\Layouts\ImagesListLayout;
use App\Images;

class ImagesListScreen extends Screen {

  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Images';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'Upload images for websites';

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array {

   return [
     ImagesListLayout::class,
     Layout::view('jquery'),
     Layout::view('imageviewer')
   ];
  }

  /**
   * Query data.
   *
   * @return array
   */
  public function query(): array {

   return [
    'images' => Images::paginate(10)
   ];
  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array {

    return [
      Link::make(__('Add an image'))
        ->icon('icon-plus')
        ->href(route('platform.image.edit'))
    ];
  }
}
