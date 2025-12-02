# Quick Reference Guide - Laravel Imgenerate Faker

## Installation

```bash
composer require naim886/imgenerate-laravel-faker
```

## Basic Usage

### Generate URL
```php
use Imgenerate\LaravelFaker\Facades\Imgenerate;

// Simple URL
$url = Imgenerate::url();

// With dimensions
$url = Imgenerate::url(800, 600);

// With category
$url = Imgenerate::url(800, 600, 'nature');
```

### Save to Storage
```php
// Save to default location
$path = Imgenerate::save(800, 600);

// Save with category and path
$path = Imgenerate::save(800, 600, 'nature', 'products');

// Save to S3
$path = Imgenerate::disk('s3')->save(800, 600);
```

### Method Chaining
```php
$url = Imgenerate::dimensions(1920, 1080)
    ->category('technology')
    ->get();
```

## Faker Provider

### Setup
```php
$faker = \Faker\Factory::create();
$faker->addProvider(new \Imgenerate\LaravelFaker\FakerProvider($faker));
```

### Methods
```php
// Basic
$faker->imgenerateUrl(800, 600, 'nature');

// Square
$faker->imgenerateSquare(500);

// Avatar
$faker->imgenerateAvatar(200);

// Product
$faker->imgenerateProduct(800, 600);

// Background
$faker->imgenerateBackground(1920, 1080);

// Thumbnail
$faker->imgenerateThumbnail(150);

// Random dimensions
$faker->imgenerateRandom([400, 1200], [300, 900]);

// Save to storage
$faker->imgenerateSave(800, 600, 'nature', 'images');
```

## Model Factories

### Using Facade
```php
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image' => Imgenerate::url(800, 600, 'products'),
            'image_path' => Imgenerate::save(800, 600, 'products', 'products'),
        ];
    }
}
```

### Using Faker Provider
```php
class UserFactory extends Factory
{
    public function definition(): array
    {
        fake()->addProvider(new \Imgenerate\LaravelFaker\FakerProvider(fake()));
        
        return [
            'name' => fake()->name(),
            'avatar' => fake()->imgenerateAvatar(200),
            'cover' => fake()->imgenerateBackground(1920, 1080),
        ];
    }
}
```

## Available Categories

- `abstract` - Abstract patterns
- `animals` - Animal photos
- `business` - Business scenes
- `cats` - Cat images
- `city` - Urban landscapes
- `food` - Food and drinks
- `nature` - Nature landscapes
- `nightlife` - Night scenes
- `people` - People portraits
- `sports` - Sports activities
- `technology` - Tech gadgets
- `transport` - Vehicles

## Configuration

Publish config:
```bash
php artisan vendor:publish --tag=imgenerate-config
```

Default settings:
```php
return [
    'default_width' => 640,
    'default_height' => 480,
    'default_category' => null,
    'default_disk' => 'public',
    'default_path' => 'images',
    'timeout' => 30,
];
```

## Advanced Examples

### Multiple Images
```php
$images = Imgenerate::multiple(5, 800, 600, 'nature');
```

### Custom Disk and Path
```php
$path = Imgenerate::disk('s3')
    ->dimensions(1000, 1000)
    ->category('products')
    ->save(null, null, null, 'uploads/products', 'featured.jpg');
```

### Product with Gallery
```php
class ProductFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            for ($i = 0; $i < 5; $i++) {
                $product->images()->create([
                    'path' => Imgenerate::save(800, 800, 'products', 'products/gallery'),
                ]);
            }
        });
    }
}
```

## Testing

Run tests:
```bash
vendor/bin/phpunit
```

or

```bash
composer test
```

## API Response

Generated URLs format:
```
https://imgenerate.com/generate?width={width}&height={height}&text={category}&random={string}
```

Example:
```
https://imgenerate.com/generate?width=800&height=600&text=nature&random=abc123xyz
```

## Common Use Cases

### Blog Post Featured Image
```php
'featured_image' => fake()->imgenerateBackground(1200, 630) // OG image size
```

### E-commerce Product
```php
'main_image' => Imgenerate::save(1000, 1000, 'products', 'products/main'),
'thumbnail' => Imgenerate::save(300, 300, 'products', 'products/thumbnails'),
```

### User Profile
```php
'avatar' => fake()->imgenerateAvatar(200),
'cover_photo' => fake()->imgenerateBackground(1920, 400),
```

### Gallery/Portfolio
```php
$images = Imgenerate::multiple(10, 1200, 800, 'nature');
```

## Tips

1. **Random URLs**: Each URL includes a random parameter to avoid browser caching
2. **File Extensions**: Saved files automatically get `.jpg` extension
3. **Storage**: Works with any Laravel storage disk (local, S3, etc.)
4. **Chainable**: Most methods support chaining for cleaner code
5. **Type Safe**: Full PHP type hints for better IDE support

## Troubleshooting

### Image not saving
- Check storage disk configuration
- Ensure directory has write permissions
- Verify internet connection

### Timeout errors
- Increase timeout in config: `'timeout' => 60`
- Check network connection
- Verify API is accessible

### URL not loading
- Ensure imgenerate.com is accessible
- Check if random parameter is present
- Verify dimensions are valid

