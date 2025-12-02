# Laravel Imgenerate Faker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/naim886/imgenerate.svg?style=flat-square)](https://packagist.org/packages/naim886/imgenerate)
[![Total Downloads](https://img.shields.io/packagist/dt/naim886/imgenerate.svg?style=flat-square)](https://packagist.org/packages/naim886/imgenerate)

A Laravel package to generate fake images using [imgenerate.com](https://www.imgenerate.com) API for testing and development purposes. Perfect for seeding databases with realistic placeholder images.

## Features

- 🎨 Generate fake images with custom dimensions
- 🎯 Multiple image categories (nature, people, technology, etc.)
- 💾 Save images directly to Laravel storage
- 🔗 Get image URLs for external use
- 🎭 Integrate seamlessly with Laravel Faker
- 🚀 Easy to use and configure

## Installation

You can install the package via composer:

```bash
composer require naim886/imgenerate-laravel-faker
```

The package will automatically register itself.

## Configuration

Optionally, you can publish the configuration file:

```bash
php artisan vendor:publish --tag=imgenerate-config
```

This will create a `config/imgenerate.php` file where you can customize default settings.

## Usage

### Basic Usage

```php
use Imgenerate\LaravelFaker\Facades\Imgenerate;

// Generate a random image URL
$imageUrl = Imgenerate::url();

// Generate with specific dimensions
$imageUrl = Imgenerate::url(800, 600);

// Generate with custom text
$imageUrl = Imgenerate::url(800, 600, ['text' => 'My Custom Text']);

// Generate with all customization options
$imageUrl = Imgenerate::url(400, 400, [
    'bg' => '1e3a8a',           // Background color (hex without #)
    'text_color' => 'ffffff',    // Text color (hex without #)
    'font_size' => 24,           // Font size
    'angle' => 0,                // Text rotation angle (0-360)
    'text' => 'www.imgenerate.com', // Custom text
    'format' => 'jpg'            // Image format (jpg, png, webp)
]);
```

### Customization Parameters

The package supports full customization of generated images:

- **width**: Image width in pixels (e.g., 400, 800, 1920)
- **height**: Image height in pixels (e.g., 400, 600, 1080)
- **bg**: Background color as hex code without # (e.g., '1e3a8a', 'ff5733')
- **text_color**: Text color as hex code without # (e.g., 'ffffff', '000000')
- **font_size**: Font size for text (e.g., 12, 24, 48)
- **angle**: Text rotation angle in degrees 0-360 (e.g., 0, 45, 90)
- **text**: Custom text to display on image (e.g., 'Hello World', 'Product Name')
- **format**: Image format (e.g., 'jpg', 'png', 'webp')

### Using Fluent Interface

```php
// Chain methods for clean configuration
$imageUrl = Imgenerate::dimensions(400, 400)
    ->bg('1e3a8a')
    ->textColor('ffffff')
    ->fontSize(24)
    ->angle(0)
    ->text('www.imgenerate.com')
    ->format('jpg')
    ->get();
```

### Using with Laravel Faker

In your model factories:

```php
use Illuminate\Database\Eloquent\Factories\Factory;
use Imgenerate\LaravelFaker\Facades\Imgenerate;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'image' => Imgenerate::url(800, 600, [
                'text' => 'Product',
                'bg' => 'e5e7eb',
                'text_color' => '1f2937'
            ]),
            // or save to storage
            'image_path' => Imgenerate::save(800, 600, [
                'text' => 'Product Image',
                'bg' => 'f3f4f6',
                'text_color' => '111827'
            ], 'products'),
        ];
    }
}
```

### Using the Faker Provider

Add the provider to your factory or test:

```php
$faker = \Faker\Factory::create();
$faker->addProvider(new \Imgenerate\LaravelFaker\FakerProvider($faker));

// Now you can use
$imageUrl = $faker->imgenerateUrl(800, 600);
$imageUrl = $faker->imgenerateUrl(800, 600, [
    'text' => 'Nature',
    'bg' => '10b981',
    'text_color' => 'ffffff'
]);
$savedPath = $faker->imgenerateSave(800, 600, [
    'text' => 'Saved Image',
    'bg' => '3b82f6'
], 'images');
```

### Save Images to Storage

```php
// Save to default disk (usually 'public')
$path = Imgenerate::save(800, 600);

// Save with custom options
$path = Imgenerate::save(800, 600, [
    'text' => 'Saved Image',
    'bg' => '1e3a8a',
    'text_color' => 'ffffff',
    'font_size' => 24
]);

// Save to specific disk
$path = Imgenerate::disk('s3')->save(800, 600, [
    'text' => 'Cloud Storage'
]);

// Save to specific folder
$path = Imgenerate::save(800, 600, [
    'text' => 'Nature',
    'bg' => '10b981'
], 'uploads/images');
```

### Advanced Usage

```php
// Chain methods for configuration
$imageUrl = Imgenerate::text('Beautiful Landscape')
    ->dimensions(1920, 1080)
    ->bg('059669')
    ->textColor('ffffff')
    ->fontSize(48)
    ->get();

// Generate multiple images
$images = Imgenerate::multiple(5, 800, 600, [
    'text' => 'Gallery Image',
    'bg' => 'd97706',
    'text_color' => 'ffffff'
]);

// Download image content
$content = Imgenerate::download(800, 600, [
    'text' => 'Downloaded Image',
    'bg' => '7c3aed'
]);

// Complex example with all options
$imageUrl = Imgenerate::url(1200, 630, [
    'bg' => '1e40af',
    'text_color' => 'fbbf24',
    'font_size' => 32,
    'angle' => 0,
    'text' => 'Welcome to Our Site',
    'format' => 'png'
]);
```

### Practical Examples

```php
// Generate a logo placeholder
$logo = Imgenerate::url(200, 200, [
    'bg' => '000000',
    'text_color' => 'ffffff',
    'font_size' => 48,
    'text' => 'LOGO'
]);

// Generate a banner
$banner = Imgenerate::url(1200, 400, [
    'bg' => '3b82f6',
    'text_color' => 'ffffff',
    'font_size' => 56,
    'text' => 'SALE - 50% OFF'
]);

// Generate a social media image
$socialImage = Imgenerate::url(1200, 630, [
    'bg' => 'ec4899',
    'text_color' => 'ffffff',
    'font_size' => 42,
    'text' => 'Check out our new blog post!'
]);

// Generate a product thumbnail
$thumbnail = Imgenerate::url(300, 300, [
    'bg' => 'f3f4f6',
    'text_color' => '1f2937',
    'font_size' => 18,
    'text' => 'Product'
]);
```

## Configuration Options

```php
return [
    // Default image width
    'default_width' => 640,
    
    // Default image height
    'default_height' => 480,
    
    // Default category (deprecated - use 'default_text' instead)
    'default_category' => null,
    
    // Default storage disk
    'default_disk' => 'public',
    
    // Default storage path
    'default_path' => 'images',
    
    // Cache images (coming soon)
    'cache_enabled' => false,
    
    // API timeout in seconds
    'timeout' => 30,
    
    // Default background color (hex without #)
    'default_bg' => null,
    
    // Default text color (hex without #)
    'default_text_color' => null,
    
    // Default font size
    'default_font_size' => null,
    
    // Default text angle (0-360)
    'default_angle' => 0,
    
    // Default text to display
    'default_text' => null,
    
    // Default image format (jpg, png, webp)
    'default_format' => null,
];
```

You can also set these via environment variables in your `.env` file:

```env
IMGENERATE_DEFAULT_WIDTH=800
IMGENERATE_DEFAULT_HEIGHT=600
IMGENERATE_DEFAULT_BG=1e3a8a
IMGENERATE_DEFAULT_TEXT_COLOR=ffffff
IMGENERATE_DEFAULT_FONT_SIZE=24
IMGENERATE_DEFAULT_ANGLE=0
IMGENERATE_DEFAULT_TEXT="Placeholder"
IMGENERATE_DEFAULT_FORMAT=jpg
IMGENERATE_DEFAULT_DISK=public
IMGENERATE_DEFAULT_PATH=images
IMGENERATE_TIMEOUT=30
```

## Example: Complete Model Factory

```php
<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Imgenerate\LaravelFaker\Facades\Imgenerate;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $colors = ['3b82f6', 'ef4444', '10b981', 'f59e0b', '8b5cf6'];
        $randomBg = $colors[array_rand($colors)];
        
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => Imgenerate::save(800, 600, [
                'text' => 'Product',
                'bg' => $randomBg,
                'text_color' => 'ffffff',
                'font_size' => 32
            ], 'products'),
            'thumbnail' => Imgenerate::save(200, 200, [
                'text' => 'Thumb',
                'bg' => $randomBg,
                'text_color' => 'ffffff',
                'font_size' => 16
            ], 'products/thumbnails'),
        ];
    }
}
```

### User Factory Example with Avatars

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Imgenerate\LaravelFaker\Facades\Imgenerate;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $initials = strtoupper(substr($this->faker->firstName, 0, 1) . substr($this->faker->lastName, 0, 1));
        
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'avatar' => Imgenerate::url(200, 200, [
                'text' => $initials,
                'bg' => substr(md5($this->faker->email), 0, 6),
                'text_color' => 'ffffff',
                'font_size' => 48
            ]),
        ];
    }
}
```

## Example: Database Seeder

```php
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory(50)->create();
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@example.com instead of using the issue tracker.

## Credits

- [Naimul Hasan Naim](https://github.com/naim886)
- [naim886@gmail.com](../../contributors)
- [www.naimbd.com](https://naimbd.com/)
- [www.imgenerate.com](https://imgenerate.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

