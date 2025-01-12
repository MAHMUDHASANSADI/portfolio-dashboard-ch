<?php
function headerColumns($key = ''){
    $columns = [
        'blogs' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['title', 'title', 'text-center'],
            ['description', 'description', 'text-center'],
            ['date', 'date', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'business' => [
            ['SL', 'SL'],
            ['category', 'category', 'text-center'],
            ['business_name', 'business_name', 'text-center'],
            ['description', 'description', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'slider' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'hero' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['title', 'title', 'text-center'],
            ['description', 'description', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'gallery' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'program' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['title', 'title', 'text-center'],
            ['description', 'description', 'text-center'],
            ['price', 'price', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'news' => [
            ['SL', 'SL'],
            ['image', 'image', 'text-center'],
            ['title', 'title', 'text-center'],
            ['description', 'description', 'text-center'],
            ['date', 'date', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'biography' => [
            ['SL', 'SL'],
            ['description', 'description', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'business-categories' => [
            ['SL', 'SL'],
            ['category_name', 'category_name', 'text-center'],
            ['businesses', 'businesses', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'award' => [
            ['SL', 'SL'],
            ['category', 'category', 'text-center'],
            ['award_name', 'award_name', 'text-center'],
            ['description', 'description', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'award-categories' => [
            ['SL', 'SL'],
            ['category_name', 'category_name', 'text-center'],
            ['awards', 'awards', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'videos' => [
            ['SL', 'SL'],
            ['title', 'title', 'text-center'],
            ['description', 'description', 'text-center'],
            ['url', 'url', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
        'messages' => [
            ['SL', 'SL'],
            ['name', 'name', 'text-center'],
            ['phone', 'phone', 'text-center'],
            ['email', 'email', 'text-center'],
            ['subject', 'subject', 'text-center'],
            ['message', 'message', 'text-center'],
        ],
        'permission' => [
            ['SL', 'SL'],
            ['name', 'name', 'text-center'],
            ['guard_name', 'guard_name', 'text-center'],
            ['actions', 'actions', 'text-center'],
        ],
    ];

    return isset($columns[$key]) ? $columns[$key] : array(['SL', 'SL', 'text-center']);
}
