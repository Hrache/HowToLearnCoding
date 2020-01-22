<?php

declare(strict_types=1);

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Screens

// Platform > System > Users
Breadcrumbs::for('platform.systems.users', function ($trail) {
  $trail->parent('platform.systems.index');
  $trail->push(__('Users'), route('platform.systems.users'));
});

// Platform > System > Users > User
Breadcrumbs::for('platform.systems.users.edit', function ($trail, $user) {
  $trail->parent('platform.systems.users');
  $trail->push(__('Edit'), route('platform.systems.users.edit', $user));
});

// Platform > System > Roles
Breadcrumbs::for('platform.systems.roles', function ($trail) {
  $trail->parent('platform.systems.index');
  $trail->push(__('Roles'), route('platform.systems.roles'));
});

// Platform > System > Roles > Create
Breadcrumbs::for('platform.systems.roles.create', function ($trail) {
  $trail->parent('platform.systems.roles');
  $trail->push(__('Create'), route('platform.systems.roles.create'));
});

// Platform > System > Roles > Role
Breadcrumbs::for('platform.systems.roles.edit', function ($trail, $role) {
  $trail->parent('platform.systems.roles');
  $trail->push(__('Role'), route('platform.systems.roles.edit', $role));
});

// Platform -> Example
Breadcrumbs::for('platform.example', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('Example'));
});


// Platform > All comments
Breadcrumbs::for('platform.comments.list', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('All comments'), route('platform.comments.list'));
});

// Platform > Latest comments
Breadcrumbs::for('platform.comments.latest', function ($trail) {
  $trail->parent('platform.comments.list');
  $trail->push(__('Latest comments'), route('platform.comments.latest'));
});

// Platform > Edit or create an comment
Breadcrumbs::for('platform.comment.edit', function ($trail) {
  $trail->parent('platform.comments.list');
  $trail->push(__('Edit or create an comment'), route('platform.comment.edit'));
});

// Platform > All websites
Breadcrumbs::for('platform.websites.list', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('All websites'), route('platform.websites.list'));
});

// Platform > All websites > Edit or create an website
Breadcrumbs::for('platform.website.edit', function ($trail) {
  $trail->parent('platform.websites.list');
  $trail->push(__('Edit or create an website'), route('platform.website.edit'));
});

// Platform > All articles
Breadcrumbs::for('platform.articles.list', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('All articles'), route('platform.articles.list'));
});

// Platform > All articles > Edit or create an article
Breadcrumbs::for('platform.article.edit', function ($trail) {
  $trail->parent('platform.articles.list');
  $trail->push(__('Edit or create an article'), route('platform.article.edit'));
});

// Platform > All images
Breadcrumbs::for('platform.images.list', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('All images'), route('platform.images.list'));
});

// Platform > All images > Edit or add an image
Breadcrumbs::for('platform.image.edit', function ($trail) {
  $trail->parent('platform.images.list');
  $trail->push(__('Edit or add an image'), route('platform.image.edit'));
});

// Platform > All images > Edit or add an image
Breadcrumbs::for('platform.pages', function ($trail) {
  $trail->parent('platform.index');
  $trail->push(__('Edit or add an image'), route('platform.pages'));
});