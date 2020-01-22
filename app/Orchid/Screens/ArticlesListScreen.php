<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;

use App\Orchid\Layouts\ArticlesListLayout;
use App\Articles;

class ArticlesListScreen extends Screen {

  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Articles';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'The list of the articles';

  /**
   * Query data.
   *
   * @return array
   */
  public function query(): array {

    return [
      'articles' => Articles::filters()->paginate()
    ];
  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array {

    return [
      Link::make(__('Create a article'))
        ->icon('icon-plus')
        ->href(route('platform.article.edit'))
    ];
  }

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array {

    return [
      ArticlesListLayout::class,
      Layout::view('jquery'),
      Layout::view('summernote')
    ];
  }
}
