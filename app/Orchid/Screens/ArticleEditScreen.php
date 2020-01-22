<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

use App\Orchid\Layouts\ArticleEditLayout;
use App\Articles;

class ArticleEditScreen extends Screen {

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
  public $description = 'Add a new article';

  /**
   * @var bool
   */
  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(Articles $article): array {

   $this->exists = $article->exists;

   if ($this->exists) {

    $this->name = 'Edit the article';

   }

   return ['article' => $article];

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
    ArticleEditLayout::class,
    Layout::view('jquery'),
    Layout::view('summernote')
   ];

  }

  /**
   * @param Articles $article
   * @param Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */

  public function createOrUpdate(Articles $article, Request $request) {

    $validator = validator($request->get('article'), [
     'title' => 'required|string',
     'role' => 'required|string|max:128',
     'article' => 'required|string',
     'website_id' => 'required|integer'
    ]);

    if ($validator->fails()) {

     Alert::error(implode('<br />', $validator->errors()->all()));

    } else {

     $article->fill($request->get('article'))->save();

     Alert::info('You have successfully created/added an article.');

    }

    return redirect()->route('platform.article.edit', ['article' => $article]);
  }

  /**
   * @param Articles $article
   *
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */

  public function remove(Articles $article) {

    $article->delete()?
      Alert::info('You have successfully deleted the article.'):
      Alert::warning('An error has occurred');

    return redirect()->route('platform.articles.list');
  }
}