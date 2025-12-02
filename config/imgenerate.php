<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Width
    |--------------------------------------------------------------------------
    |
    | The default width for generated images in pixels.
    |
    */

    'default_width' => env('IMGENERATE_DEFAULT_WIDTH', 640),

    /*
    |--------------------------------------------------------------------------
    | Default Image Height
    |--------------------------------------------------------------------------
    |
    | The default height for generated images in pixels.
    |
    */

    'default_height' => env('IMGENERATE_DEFAULT_HEIGHT', 480),

    /*
    |--------------------------------------------------------------------------
    | Default Category
    |--------------------------------------------------------------------------
    |
    | The default category for generated images.
    | Available: abstract, animals, business, cats, city, food, nature,
    | nightlife, people, sports, technology, transport
    |
    */

    'default_category' => env('IMGENERATE_DEFAULT_CATEGORY', null),

    /*
    |--------------------------------------------------------------------------
    | Default Storage Disk
    |--------------------------------------------------------------------------
    |
    | The default disk to use when saving images.
    |
    */

    'default_disk' => env('IMGENERATE_DEFAULT_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Default Storage Path
    |--------------------------------------------------------------------------
    |
    | The default path within the disk to save images.
    |
    */

    'default_path' => env('IMGENERATE_DEFAULT_PATH', 'images'),

    /*
    |--------------------------------------------------------------------------
    | Cache Enabled
    |--------------------------------------------------------------------------
    |
    | Enable caching of downloaded images to avoid duplicate downloads.
    | (Coming soon)
    |
    */

    'cache_enabled' => env('IMGENERATE_CACHE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | API Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout in seconds for API requests.
    |
    */

    'timeout' => env('IMGENERATE_TIMEOUT', 30),

];

