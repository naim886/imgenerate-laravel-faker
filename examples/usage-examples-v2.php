<?php

/**
 * Imgenerate Laravel Faker - Complete Usage Examples
 * Version 1.1.0 - Full Customization Support
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Imgenerate\LaravelFaker\ImgenerateService;

echo "=== Imgenerate Laravel Faker - Usage Examples ===\n\n";

// Example 1: Basic usage
$service = new ImgenerateService();

echo "1. BASIC IMAGE URL:\n";
$imageUrl = $service->url(800, 600);
echo "   {$imageUrl}\n\n";

// Example 2: Using custom text
echo "2. IMAGE WITH CUSTOM TEXT:\n";
$textImage = $service->url(800, 600, ['text' => 'Hello World']);
echo "   {$textImage}\n\n";

// Example 3: Full customization (like imgenerate.com example)
echo "3. FULLY CUSTOMIZED IMAGE (www.imgenerate.com style):\n";
$customImage = $service->url(400, 400, [
    'bg' => '1e3a8a',
    'text_color' => 'ffffff',
    'font_size' => 24,
    'angle' => 0,
    'text' => 'www.imgenerate.com'
]);
echo "   {$customImage}\n\n";

// Example 4: Chaining methods (fluent interface)
echo "4. USING FLUENT INTERFACE:\n";
$chainedUrl = $service->dimensions(1200, 800)
    ->bg('3b82f6')
    ->textColor('ffffff')
    ->fontSize(32)
    ->angle(0)
    ->text('Chained Methods')
    ->format('jpg')
    ->get();
echo "   {$chainedUrl}\n\n";

// Example 5: Generate multiple images
echo "5. MULTIPLE IMAGES:\n";
$multipleImages = $service->multiple(3, 640, 480, [
    'text' => 'Gallery Image',
    'bg' => 'd97706',
    'text_color' => 'ffffff'
]);
foreach ($multipleImages as $index => $url) {
    echo "   " . ($index + 1) . ". {$url}\n";
}
echo "\n";

// Example 6: Different sizes and colors
echo "6. DIFFERENT SIZES AND COLORS:\n";
$variations = [
    'thumbnail' => [150, 150, 'ef4444', 'Thumb'],
    'medium' => [640, 480, '10b981', 'Medium'],
    'large' => [1920, 1080, '8b5cf6', 'Large'],
];

foreach ($variations as $name => $config) {
    $url = $service->url($config[0], $config[1], [
        'bg' => $config[2],
        'text_color' => 'ffffff',
        'text' => $config[3],
        'font_size' => 24
    ]);
    echo "   {$name}: {$url}\n";
}
echo "\n";

// Example 7: Logo placeholder
echo "7. LOGO PLACEHOLDER:\n";
$logo = $service->url(200, 200, [
    'bg' => '000000',
    'text_color' => 'ffffff',
    'font_size' => 48,
    'text' => 'LOGO'
]);
echo "   {$logo}\n\n";

// Example 8: Banner
echo "8. BANNER IMAGE:\n";
$banner = $service->url(1200, 400, [
    'bg' => '3b82f6',
    'text_color' => 'ffffff',
    'font_size' => 56,
    'text' => 'SALE - 50% OFF'
]);
echo "   {$banner}\n\n";

// Example 9: Social media image
echo "9. SOCIAL MEDIA IMAGE:\n";
$socialImage = $service->url(1200, 630, [
    'bg' => 'ec4899',
    'text_color' => 'ffffff',
    'font_size' => 42,
    'text' => 'Check out our new blog post!'
]);
echo "   {$socialImage}\n\n";

// Example 10: Using with Faker
echo "10. FAKER PROVIDER EXAMPLES:\n";
$faker = Faker\Factory::create();
$faker->addProvider(new \Imgenerate\LaravelFaker\FakerProvider($faker));

echo "   Random Image: " . $faker->imgenerateUrl(800, 600, [
    'text' => 'Random',
    'bg' => 'f59e0b'
]) . "\n";

echo "   Square Image: " . $faker->imgenerateSquare(500, [
    'text' => 'Square',
    'bg' => '06b6d4'
]) . "\n";

echo "   Avatar Image: " . $faker->imgenerateAvatar(200, [
    'text' => 'AV',
    'bg' => '8b5cf6',
    'font_size' => 64
]) . "\n";

echo "   Product Image: " . $faker->imgenerateProduct(800, 600, [
    'text' => 'Product',
    'bg' => 'f3f4f6',
    'text_color' => '1f2937'
]) . "\n";

echo "   Background Image: " . $faker->imgenerateBackground(1920, 1080, [
    'text' => 'Background',
    'bg' => '059669'
]) . "\n";

echo "   Thumbnail Image: " . $faker->imgenerateThumbnail(150, [
    'text' => 'Thumb',
    'bg' => 'dc2626'
]) . "\n";

echo "   Random Size Image: " . $faker->imgenerateRandom([400, 800], [300, 600], [
    'text' => 'Random Size',
    'bg' => '7c3aed'
]) . "\n\n";

// Example 11: Different formats
echo "11. DIFFERENT IMAGE FORMATS:\n";
$formats = ['jpg', 'png', 'webp'];
foreach ($formats as $format) {
    $url = $service->url(400, 300, [
        'text' => strtoupper($format),
        'bg' => '6366f1',
        'text_color' => 'ffffff',
        'format' => $format
    ]);
    echo "   {$format}: {$url}\n";
}
echo "\n";

// Example 12: Angled text
echo "12. ANGLED TEXT:\n";
$angles = [0, 45, 90, 180, 270];
foreach ($angles as $angle) {
    $url = $service->url(400, 400, [
        'text' => "{$angle}°",
        'bg' => '14b8a6',
        'text_color' => 'ffffff',
        'angle' => $angle,
        'font_size' => 48
    ]);
    echo "   {$angle}°: {$url}\n";
}
echo "\n";

echo "=== All examples completed! ===\n";

