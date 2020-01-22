<?php

namespace App\Orchid\Screens;

use App\Websites;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Orchid\Layouts\ImageEditLayout;
use App\Images;

class ImageEditScreen extends Screen
{

  /**
   * Display header name.
   *
   * @var string
   */

  public $name = 'Image';

  /**
   * Display header description.
   *
   * @var string
   */

  public $description = 'Change current image';

  /**
   * @var bool
   */

  public $exists = false;

  /**
   * Views.
   *
   * @return Layout[]
   */

  public function layout(): array {

   return [
    ImageEditLayout::class
   ];

  }

  /**
   * Query data.
   *
   * @return array
   */

  public function query(Images $image): array {

   $this->exists = $image->exists;

   if ($this->exists) {

    $this->name = 'Edit the image';
   }

   return ['image' => $image];
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
      ->canSee($this->exists)
    ];
  }

  /**
   * @param Images $image
   * @param  Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function createOrUpdate(Images $image, Request $request) {

   $validator = validator($request->get('image'), [
    // 'image' => 'required|file|mimes:jpeg,jpg,png,bmp|max:2048',
    'role' => 'required|in:cover,intro,body,last',
    'website_id' => 'required|integer'
   ]);

   if ($validator->fails()) {

    Alert::error(implode('<br />', $validator->errors()->all()));

   } else {

    $image->fill($request->get('image'))->save();
    Alert::success("Image've been saved.");
   }

   return redirect()->route('platform.image.edit', ['image' => $image]);
  }

  /**
   * @param Images $image
   *
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function remove(Images $image) {

    $filepath = str_replace(config('app.url').'/storage/', '', $image->image);

    if (Storage::disk('public')->exists($filepath)) {

     Storage::delete($filepath);

     $image->delete()?
      Alert::info('You have successfully deleted the image.'):
      Alert::warning('An error has occurred');

    } else {

     Alert::error('The physical image was missing.');
    }

    return redirect()->route('platform.images.list');
  }
}