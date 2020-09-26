<?php

use App\Models\Region;
use App\Models\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::register('home', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->push('Home', route('home'));
});

Breadcrumbs::register('register', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('login', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('password.request', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

Breadcrumbs::register('cabinet', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet'));
});

////////// ADMIN USERS

Breadcrumbs::register('admin.home', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Admin panel', route('admin.home'));
});

Breadcrumbs::register('admin.users.index', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Create user', route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (BreadcrumbsGenerator $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (BreadcrumbsGenerator $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push($user->name, route('admin.users.edit', $user));
});

////////// ADMIN REGION

Breadcrumbs::register('admin.regions.index', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (BreadcrumbsGenerator $crumbs) {
    if ($parentId = request()->get('parent')) {
        $region = Region::findOrFail($parentId);
        $crumbs->parent('admin.regions.show', $region);
    } else {
        $crumbs->parent('admin.regions.index');
    }
    $crumbs->push('Create region', route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (BreadcrumbsGenerator $crumbs, Region $region) {
    if ($region->parent_id) {
        $crumbs->parent('admin.regions.show', $region->parent);
    } else {
        $crumbs->parent('admin.regions.index');
    }
    $crumbs->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (BreadcrumbsGenerator $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push($region->name, route('admin.regions.edit', $region));
});
