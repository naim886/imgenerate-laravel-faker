<?php

/**
 * Example Usage File - Demonstrates various ways to use the Imgenerate package
 */

use Imgenerate\LaravelFaker\Facades\Imgenerate;

// ============================================================================
// BASIC USAGE
// ============================================================================

// Generate a simple image URL
$imageUrl = Imgenerate::url();
// Result: https://www.imgenerate.com/api/image/640x480?random=xxxxx

// Generate with custom dimensions
$imageUrl = Imgenerate::url(1920, 1080);
// Result: https://www.imgenerate.com/api/image/1920x1080?random=xxxxx

// Generate with category
$imageUrl = Imgenerate::url(800, 600, 'nature');
// Result: https://www.imgenerate.com/api/image/800x600/nature?random=xxxxx


// ============================================================================
// CHAINABLE METHODS
// ============================================================================

// Using method chaining
$imageUrl = Imgenerate::dimensions(1920, 1080)
    ->category('technology')
    ->get();

// ============================================================================
// SAVE TO STORAGE
// ============================================================================

// Save image to default disk (public) and default path (images)
$path = Imgenerate::save(800, 600);
// Result: images/xxxxx.jpg

// Save to specific folder
$path = Imgenerate::save(800, 600, 'nature', 'uploads/products');
// Result: uploads/products/xxxxx.jpg

// Save to specific disk
$path = Imgenerate::disk('s3')->save(800, 600, 'technology');

// Save with custom filename
$path = Imgenerate::save(800, 600, 'food', 'products', 'featured-product.jpg');
// Result: products/featured-product.jpg


// ============================================================================
// MULTIPLE IMAGES
// ============================================================================

// Generate 5 image URLs
$images = Imgenerate::multiple(5, 800, 600, 'nature');
// Result: array of 5 URLs


// ============================================================================
// USING WITH FAKER PROVIDER
// ============================================================================

$faker = \Faker\Factory::create();
$faker->addProvider(new \Imgenerate\LaravelFaker\FakerProvider($faker));

// Basic usage
$imageUrl = $faker->imgenerateUrl(800, 600);
$imageUrl = $faker->imgenerateUrl(800, 600, 'nature');

// Save to storage
$imagePath = $faker->imgenerateSave(800, 600, 'technology', 'uploads');

// Random dimensions
$imageUrl = $faker->imgenerateRandom([400, 1200], [300, 900]);

// Square image
$imageUrl = $faker->imgenerateSquare(500);
$imageUrl = $faker->imgenerateSquare(500, 'abstract');

// Avatar
$avatarUrl = $faker->imgenerateAvatar(200);

// Product image
$productUrl = $faker->imgenerateProduct(800, 600);

// Background image
$bgUrl = $faker->imgenerateBackground(1920, 1080);

// Thumbnail
$thumbUrl = $faker->imgenerateThumbnail(150);


// ============================================================================
// IN MODEL FACTORIES
// ============================================================================

// In database/factories/ProductFactory.php
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'image' => Imgenerate::url(800, 600, 'products'),
            'image_path' => Imgenerate::save(800, 600, 'food', 'products'),
            'thumbnail' => Imgenerate::save(200, 200, 'food', 'products/thumbnails'),
        ];
    }
}

// Or using Faker Provider
class ProductFactory extends Factory
{
    public function definition(): array
    {
        fake()->addProvider(new \Imgenerate\LaravelFaker\FakerProvider(fake()));

        return [
            'name' => fake()->words(3, true),
            'image' => fake()->imgenerateProduct(800, 600),
            'thumbnail' => fake()->imgenerateThumbnail(200),
        ];
    }
}


// ============================================================================
// AVAILABLE CATEGORIES
// ============================================================================

$categories = Imgenerate::categories();
/*
 * Result: [
 *   'abstract',
 *   'animals',
 *   'business',
 *   'cats',
 *   'city',
 *   'food',
 *   'nature',
 *   'nightlife',
 *   'people',
 *   'sports',
 *   'technology',
 *   'transport',
 * ]
 */


// ============================================================================
// IN CONTROLLERS/SERVICES
// ============================================================================

namespace App\Http\Controllers;

use Imgenerate\LaravelFaker\Facades\Imgenerate;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // For testing/demo purposes, generate a fake product image
        $imagePath = Imgenerate::save(800, 600, 'food', 'products');

        $product = Product::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return response()->json($product);
    }
}


// ============================================================================
// IN TESTS
// ============================================================================

namespace Tests\Feature;

use Imgenerate\LaravelFaker\Facades\Imgenerate;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_can_have_image()
    {
        $product = Product::factory()->create([
            'image' => Imgenerate::url(800, 600, 'products'),
        ]);

        $this->assertNotNull($product->image);
        $this->assertStringContainsString('imgenerate.com', $product->image);
    }
}


// ============================================================================
// REAL-WORLD EXAMPLE: Blog Post
// ============================================================================

namespace Database\Factories;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        fake()->addProvider(new \Imgenerate\LaravelFaker\FakerProvider(fake()));

        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->paragraphs(5, true),
            'featured_image' => fake()->imgenerateBackground(1200, 630), // OG image size
            'author_id' => User::factory(),
            'category' => fake()->randomElement(['technology', 'business', 'nature']),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}


// ============================================================================
// REAL-WORLD EXAMPLE: E-commerce Product with Gallery
// ============================================================================

namespace Database\Factories;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'sku' => fake()->unique()->ean8(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'main_image' => Imgenerate::save(1000, 1000, 'products', 'products/main'),
            'thumbnail' => Imgenerate::save(300, 300, 'products', 'products/thumbnails'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Create product gallery with 3-5 images
            $imageCount = rand(3, 5);
            for ($i = 0; $i < $imageCount; $i++) {
                $product->images()->create([
                    'path' => Imgenerate::save(800, 800, 'products', 'products/gallery'),
                    'position' => $i,
                ]);
            }
        });
    }
}

