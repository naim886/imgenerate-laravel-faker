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

// Generate with category
$imageUrl = Imgenerate::url(1920, 1080, 'nature');
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
            'image' => Imgenerate::url(800, 600, 'products'),
            // or save to storage
            'image_path' => Imgenerate::save(800, 600, 'products', 'products'),
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
$imageUrl = $faker->imgenerateUrl(800, 600, 'nature');
$savedPath = $faker->imgenerateSave(800, 600, 'nature', 'images');
```

### Save Images to Storage

```php
// Save to default disk (usually 'public')
$path = Imgenerate::save(800, 600);

// Save to specific disk
$path = Imgenerate::disk('s3')->save(800, 600);

// Save to specific folder
$path = Imgenerate::save(800, 600, 'nature', 'uploads/images');
```

### Available Categories

- `abstract` - Abstract patterns and shapes
- `animals` - Animal photos
- `business` - Business and office scenes
- `cats` - Cat images
- `city` - Urban and city landscapes
- `food` - Food and drinks
- `nature` - Nature and landscapes
- `nightlife` - Night scenes
- `people` - People and portraits
- `sports` - Sports activities
- `technology` - Tech and gadgets
- `transport` - Vehicles and transportation

### Advanced Usage

```php
// Chain methods for configuration
$imageUrl = Imgenerate::category('nature')
    ->dimensions(1920, 1080)
    ->get();

// Generate multiple images
$images = Imgenerate::multiple(5, 800, 600, 'nature');

// Download image as file
$content = Imgenerate::download(800, 600, 'nature');
```

## Configuration Options

```php
return [
    // Default image width
    'default_width' => 640,
    
    // Default image height
    'default_height' => 480,
    
    // Default category
    'default_category' => null,
    
    // Default storage disk
    'default_disk' => 'public',
    
    // Default storage path
    'default_path' => 'images',
    
    // Cache images (coming soon)
    'cache_enabled' => false,
    
    // API timeout in seconds
    'timeout' => 30,
];
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
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => Imgenerate::save(800, 600, 'products', 'products'),
            'thumbnail' => Imgenerate::save(200, 200, 'products', 'products/thumbnails'),
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

