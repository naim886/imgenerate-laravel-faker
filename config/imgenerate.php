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

    /*
    |--------------------------------------------------------------------------
    | Default Background Color
    |--------------------------------------------------------------------------
    |
    | The default background color (hex code without #).
    | Example: '1e3a8a' for blue
    |
    */

    'default_bg' => env('IMGENERATE_DEFAULT_BG', null),

    /*
    |--------------------------------------------------------------------------
    | Default Text Color
    |--------------------------------------------------------------------------
    |
    | The default text color (hex code without #).
    | Example: 'ffffff' for white
    |
    */

    'default_text_color' => env('IMGENERATE_DEFAULT_TEXT_COLOR', null),

    /*
    |--------------------------------------------------------------------------
    | Default Font Size
    |--------------------------------------------------------------------------
    |
    | The default font size for text on the image.
    |
    */

    'default_font_size' => env('IMGENERATE_DEFAULT_FONT_SIZE', null),

    /*
    |--------------------------------------------------------------------------
    | Default Text Angle
    |--------------------------------------------------------------------------
    |
    | The default angle for text rotation (0-360 degrees).
    |
    */

    'default_angle' => env('IMGENERATE_DEFAULT_ANGLE', 0),

    /*
    |--------------------------------------------------------------------------
    | Default Text
    |--------------------------------------------------------------------------
    |
    | The default text to display on the image.
    |
    */

    'default_text' => env('IMGENERATE_DEFAULT_TEXT', null),

    /*
    |--------------------------------------------------------------------------
    | Default Image Format
    |--------------------------------------------------------------------------
    |
    | The default image format (jpg, png, webp, etc.).
    |
    */

    'default_format' => env('IMGENERATE_DEFAULT_FORMAT', null),

];

