<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;

use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

use App\Comments;
use App\Websites;

class WebsiteEditScreen extends Screen
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
  public $description = 'Add a new website';

  /**
   * @var bool
   */
  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(Websites $website): array {

   $this->exists = $website->exists;

   if ($this->exists) {

    $this->description = 'Edit the website';

   }

   return [
    'website' => $website
   ];
  }

  /**
   * Button commands.
   *
   * @return Action[]
   */
  public function commandBar(): array {

    return [
      Button::make('Add new')
        ->icon('icon-pencil')
        ->method('createOrUpdate')
        ->canSee(!$this->exists),

      Button::make('Update')
        ->icon('icon-note')
        ->method('createOrUpdate')
        ->canSee($this->exists),

      Button::make('Remove')
        ->icon('icon-trash')
        ->method('remove')
        ->canSee($this->exists),
    ];
  }

  /**
   * Views.
   *
   * @return Layout[]
   */
  public function layout(): array {

   return [

    Layout::rows([
     Field::group([

      Input::make('website.title')
        ->type('text')
        ->title('Title')
        ->max(128)
        ->required()
        ->help('Type the title of the website')
        ->placeholder('Title'),

      Input::make('website.external_url')
        ->type('url')
        ->max(255)
        ->required()
        ->title('External URL')
        ->placeholder('URL')
        ->help('The real address of the website'),

      Input::make('website.rank')
        ->type('number')
        ->title('Rank')
        ->required()
        ->help('The rank of the website (1 to 10)'),
     ])
    ])
   ];
  }

  /**
   * @param Comments $comment
   * @param  Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function createOrUpdate(Websites $website, Request $request) {

    $validator = validator($request->get('website'), [
     'title' => 'required|unique:websites|max:128',
     'external_url' => 'required|max:255',
     'rank' => 'required|integer'
    ]);

    if ($validator->fails()) {

     Alert::error(implode('<br/>', $validator->errors()->all()));
     return redirect(url()->previous());

    }

    if (Websites::all()->count() >= 10) {

     Alert::error('The maximum count of websites is reached, try to replace the existing one.');

    } else {

     $website->fill($request->get('website'))->save();
     Alert::success('You have successfully added an website.');

    }

    return redirect()->route('platform.websites.list');
  }

  /**
   * @param Comments $comment
   *
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function remove(Websites $website)
  {
    $website->delete()?
      Alert::info('You have successfully deleted the website.'):
      Alert::warning('An error has occurred');

    return redirect()->route('platform.websites.list');
  }
}