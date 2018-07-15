<?php

// Home
Breadcrumbs::register('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Forum
Breadcrumbs::register('forum', function ($trail) {
    $trail->parent('home');
    $trail->push('Forums', route('forum'));
});

// Home > About
Breadcrumbs::register('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

// Home > What's New
Breadcrumbs::register('whatsnew', function ($trail) {
    $trail->parent('home');
    $trail->push("What's New", route('whatsnew'));
});

// Home > What's New
Breadcrumbs::register('groups', function ($trail) {
    $trail->parent('home');
    $trail->push("Groups", route('groups'));
});