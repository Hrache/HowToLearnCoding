<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Illuminate\Support\Facades\Auth;

use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;

use Illuminate\Support\Facades\Route;

use App\Orchid\Layouts\StatisticsLayout;

use App\Comments;
use App\Websites;

class PlatformScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Admin Panel';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'Welcome to admin panel of "How to learn coding !live"';

  /**
   * Query data.
   *
   *
   * @return array
   */
  public function query(): array {

   return [
    'status' => Dashboard::checkUpdate(),
    'latest_comments_count' => Comments::where('updated_at', '>=', Auth::user()->last_login)->count(),
    'websites_count' => Websites::all()->count()
   ];

  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array {

    return [

     Link::make('Home')
      ->icon('icon-home')
      ->href(url('/')),

     DropDown::make('Orchid')
      ->icon('icon-task')
      ->list([

       Link::make('Home')
        ->href('http://orchid.software')
        ->icon('icon-globe-alt'),

       Link::make('Docs')
        ->href('https://orchid.software/en/docs')
        ->icon('icon-docs'),

       Link::make('GitHub')
        ->href('https://github.com/orchidsoftware/platform')
        ->icon('icon-social-github')

      ]),
    ];

  }

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array {

    return [
      Layout::view('platform::partials.update'),
      Layout::tabs([
        'Overview' => Layout::view('statistics'),
        'Platform' => Layout::view('platform::partials.welcome'),
        'Tools' => Layout::view('tools')
      ]),
    ];

  }
}
