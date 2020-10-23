<?php

use App\Models\Adverts\Attribute;
use App\Models\Adverts\Category;
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

Breadcrumbs::register('login.phone', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Confirm phone', route('login.phone'));
});

Breadcrumbs::register('password.request', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

// User cabinet

Breadcrumbs::register('cabinet.home', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet.home'));
});

Breadcrumbs::register('cabinet.profile.home', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Profile', route('cabinet.profile.home'));
});

Breadcrumbs::register('cabinet.profile.edit', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('cabinet.profile.home');
    $crumbs->push(Auth::user()->name, route('cabinet.profile.edit'));
});

Breadcrumbs::register('cabinet.profile.phone', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('cabinet.profile.home');
    $crumbs->push('Verify phone', route('cabinet.profile.phone'));
});

// Adverts //////

Breadcrumbs::register('cabinet.adverts.index', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Adverts', route('cabinet.adverts.index'));
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

////////// ADMIN CATEGORIES

Breadcrumbs::register('admin.adverts.categories.index', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Categories', route('admin.adverts.categories.index'));
});

Breadcrumbs::register('admin.adverts.categories.create', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('admin.adverts.categories.index');
    $crumbs->push('Create category', route('admin.adverts.categories.create'));
});

Breadcrumbs::register('admin.adverts.categories.show', function (BreadcrumbsGenerator $crumbs, Category $category) {
    $parent = $category->parent;
    if ($parent) {
        $crumbs->parent('admin.adverts.categories.show', $parent);
    } else {
        $crumbs->parent('admin.adverts.categories.index');
    }
    $crumbs->push($category->name, route('admin.adverts.categories.show', $category));
});

Breadcrumbs::register('admin.adverts.categories.edit', function (BreadcrumbsGenerator $crumbs, Category $category) {
    $crumbs->parent('admin.adverts.categories.show', $category);
    $crumbs->push($category->name, route('admin.adverts.categories.edit', $category));
});

////////// ADMIN CATEGORIES ATTRIBUTES

Breadcrumbs::register('admin.adverts.categories.attributes.create', function (BreadcrumbsGenerator $crumbs, Category $category) {
    $crumbs->parent('admin.adverts.categories.show', $category);
    $crumbs->push('Create attribute for ' . $category->name, route('admin.adverts.categories.attributes.create', $category));
});

Breadcrumbs::register('admin.adverts.categories.attributes.show', function (BreadcrumbsGenerator $crumbs, Category $category, Attribute $attribute) {
    $crumbs->parent('admin.adverts.categories.show', $category);
    $crumbs->push($attribute->name, route('admin.adverts.categories.attributes.show', [$category, $attribute]));
});

Breadcrumbs::register('admin.adverts.categories.attributes.edit', function (BreadcrumbsGenerator $crumbs, Category $category, Attribute $attribute) {
    $crumbs->parent('admin.adverts.categories.show', $category, $attribute);
    $crumbs->push('Edit', route('admin.adverts.categories.attributes.edit', [$category, $attribute]));
});
