<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

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

Breadcrumbs::register('verify', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Verify', route('verify'));
});

Breadcrumbs::register('password.request', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change Password', route('password.reset'));
});

Breadcrumbs::register('cabinet', function (BreadcrumbsGenerator $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet'));
});
