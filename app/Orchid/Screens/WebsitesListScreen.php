<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\WebsitesListLayout;
use Orchid\Screen\Layout;

use App\Websites;

class WebsitesListScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Websites';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'The list of websites';

  /**
   * Query data.
   *
   * @return array
   */
  public function query(): array
  {
    return [
      'websites' => Websites::filters()->paginate()
    ];
  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array
  {
    return (Websites::all()->count() < 10)? [
      Link::make(__('Create a comment'))
        ->icon('icon-plus')
        ->href(route('platform.website.edit'))
    ]: [];
  }

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array
  {
    return [
      WebsitesListLayout::class
    ];
  }
}
