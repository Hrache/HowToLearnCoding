<?php

declare(strict_types=1);

use App\Orchid\Screens\PlatformScreen;

use App\Orchid\Screens\ExampleScreen;

use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;

use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;

use App\Orchid\Screens\ArticleEditScreen;
use App\Orchid\Screens\ArticlesListScreen;

use App\Orchid\Screens\ImageEditScreen;
use App\Orchid\Screens\ImagesListScreen;

use App\Orchid\Screens\CommentEditScreen;
use App\Orchid\Screens\CommentsListScreen;

use App\Orchid\Screens\WebsiteEditScreen;
use App\Orchid\Screens\WebsitesListScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
$this->router->screen('/main', PlatformScreen::class)->name('platform.main');

// Users...
$this->router->screen('users/{users}/edit', UserEditScreen::class)->name('platform.systems.users.edit');
$this->router->screen('users', UserListScreen::class)->name('platform.systems.users');

// Roles...
$this->router->screen('roles/{roles}/edit', RoleEditScreen::class)->name('platform.systems.roles.edit');
$this->router->screen('roles/create', RoleEditScreen::class)->name('platform.systems.roles.create');
$this->router->screen('roles', RoleListScreen::class)->name('platform.systems.roles');

// Example...
$this->router->screen('example', ExampleScreen::class)->name('platform.example');

// Comments...
$this->router->screen('comment/{comment?}', CommentEditScreen::class)->name('platform.comment.edit');
$this->router->screen('comments/latest', CommentsListScreen::class)->name('platform.comments.latest');
$this->router->screen('comments/all', CommentsListScreen::class)->name('platform.comments.list');

// Websites...
$this->router->screen('websites', WebsitesListScreen::class)->name('platform.websites.list');
$this->router->screen('website/{website?}', WebsiteEditScreen::class)->name('platform.website.edit');

// Articles...
$this->router->screen('articles', ArticlesListScreen::class)->name('platform.articles.list');
$this->router->screen('article/{article?}', ArticleEditScreen::class)->name('platform.article.edit');

// Images...
$this->router->screen('image/{image?}', ImageEditScreen::class)->name('platform.image.edit');
$this->router->screen('images', ImagesListScreen::class)->name('platform.images.list');