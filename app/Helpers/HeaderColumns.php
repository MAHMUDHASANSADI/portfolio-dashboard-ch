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
    ];

    return isset($columns[$key]) ? $columns[$key] : array(['SL', 'SL', 'text-center']);
}
