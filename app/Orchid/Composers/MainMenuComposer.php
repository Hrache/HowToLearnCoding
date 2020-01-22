<?php

declare(strict_types=1);

namespace App\Orchid\Composers;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\Menu;

class MainMenuComposer
{
  /**
   * @var Dashboard
   */
  private $dashboard;

  /**
   * MenuComposer constructor.
   *
   * @param Dashboard $dashboard
   */
  public function __construct (Dashboard $dashboard) {

   $this->dashboard = $dashboard;
  }

  /**
   * Registering the main menu items.
   */
  public function compose() {

   // Main
   $this->dashboard->menu
    ->add(Menu::MAIN,
     ItemMenu::label('Articles')
      ->slug('articles')
      ->icon('icon-bag')
      ->childs()
    )
    ->add('articles',
      ItemMenu::label('All articles')
        ->route('platform.articles.list')
    )
    ->add('articles',
      ItemMenu::label('Create one')
        ->slug('create_articles')
        ->route('platform.article.edit')
    )
    ->add(Menu::MAIN,
      ItemMenu::label('Websites')
        ->slug('websites')
        ->icon('icon-bag')
        ->childs()
    )
    ->add('websites',
      ItemMenu::label('All websites')
        ->route('platform.websites.list')
    )
    ->add('websites',
     ItemMenu::label('Create one')
      ->slug('create_website')
      ->route('platform.website.edit')
    )
    ->add(Menu::MAIN,
     ItemMenu::label('Comments')
      ->slug('comments')
      ->icon('icon-bag')
      ->childs()
    )
    ->add('comments',
      ItemMenu::label('All comments')
        ->route('platform.comments.list')
    )
    ->add('comments',
      ItemMenu::label('Create one')
        ->slug('create_comments')
        ->route('platform.comment.edit')
    )
    ->add(Menu::MAIN,
     ItemMenu::label('Images')
      ->slug('images')
      ->icon('icon-bag')
      ->childs()
    )
    ->add('images',
     ItemMenu::label('All images')
      ->route('platform.images.list')
    )
    ->add('images',
     ItemMenu::label('Add one')
      ->slug('add_an_image')
      ->route('platform.image.edit')
    );
 /*
      ->add(Menu::MAIN,
        ItemMenu::label('Posts')
          ->slug('posts')
          ->icon('icon-bag')
          ->childs()
      )
      ->add('posts',
        ItemMenu::label('All posts')
          ->route('platform.post.list')
      )
      ->add('posts',
        ItemMenu::label('Create one')
          ->slug('create_post')
          ->route('platform.post.edit')
      );
*/
  }
}
