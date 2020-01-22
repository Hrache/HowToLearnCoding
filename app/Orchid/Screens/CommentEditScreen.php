<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;

use App\Orchid\Layouts\CommentEditLayout;
use App\Comments;

class CommentEditScreen extends Screen {
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Add a comment';

  /**
   * Display header description.
   *
   * @var string
   */
  public $description = 'Create or update a comment';

  /**
   * @var bool
   */
  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(Comments $comment): array {

   $this->exists = $comment->exists;

   if ($this->exists) {

    $this->name = 'Edit the comment';

   }

   return ['comment' => $comment];
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
    CommentEditLayout::class,
    Layout::view('jquery'),
    Layout::view('summernote')
   ];

  }

  /**
   * @param Comments $comment
   * @param  Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function createOrUpdate(Comments $comment, Request $request) {

   $validator = validator($request->get('comment'), [
    'email' => 'bail|required|email:strict',
    'author' => 'bail|required|max:255',
    'content' => 'bail|required|string',
    'website_id' => 'bail|required|integer'
   ]);

   if ($validator->fails()) {

    Alert::error(implode('<br/>', array_merge($validator->errors()->all(), ["Validate passed with errors, please provide proper data."])));

   }

   $comment->fill($request->get('comment'))->save();

   Alert::info('You have successfully created an comment.');

   return redirect()->route('platform.comment.edit', ['comment' => $comment]);
  }

  /**
   * @param Comments $comment
   *
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function remove(Comments $comment) {

    $comment->delete()?
     Alert::info('You have successfully deleted the comment.'):
     Alert::warning('An error has occurred');

    return redirect()->route('platform.comments.list');
  }
}
