<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Layout;

use App\Orchid\Layouts\CommentsListLayout;
use App\Comments;

class CommentsListScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Comments';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'The list of comments';

  /**
   * Means the latest comments
   *
   * @var boolean
   */
  public $latest = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(Request $request): array
  {
    if (Route::currentRouteName() === 'platform.comments.latest')
    {
      $this->name = "Latest comments";
      $this->description = "The list of latest comments";
      $this->latest = true;
    }

    return [
      'comments' => (
        ($this->latest)?
          Comments::filters()->where('updated_at', '>=', $request->user()->last_login)->paginate() :
          Comments::filters()->paginate()
      )
    ];
  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array
  {
    $cmdBar = [
      Link::make(__('Create a comment'))
        ->icon('icon-plus')
        ->href(route('platform.comment.edit'))
    ];

    if (!$this->latest)
    {
      array_unshift(
              $cmdBar,
              DropDown::make('Lists')
                ->icon('icon-task')
                ->list([
                  Link::make(__('Latest comments'))
                        ->href(route('platform.comments.latest'))
                ])
              );
    }

    return $cmdBar;
  }

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array
  {
    return [
      CommentsListLayout::class
    ];
  }
}