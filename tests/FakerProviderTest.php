<?php

namespace Imgenerate\LaravelFaker\Tests;

use Imgenerate\LaravelFaker\FakerProvider;

class FakerProviderTest extends TestCase
{
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new FakerProvider($this->faker));
    }

    /** @test */
    public function it_can_generate_image_url_via_faker()
    {
        $url = $this->faker->imgenerateUrl(800, 600);

        $this->assertIsString($url);
        $this->assertStringContainsString('imgenerate.com', $url);
        $this->assertStringContainsString('width=800', $url);
        $this->assertStringContainsString('height=600', $url);
    }

    /** @test */
    public function it_can_generate_square_image()
    {
        $url = $this->faker->imgenerateSquare(500);

        $this->assertIsString($url);
        $this->assertStringContainsString('width=500', $url);
        $this->assertStringContainsString('height=500', $url);
    }

    /** @test */
    public function it_can_generate_avatar()
    {
        $url = $this->faker->imgenerateAvatar(200);

        $this->assertIsString($url);
        $this->assertStringContainsString('width=200', $url);
        $this->assertStringContainsString('height=200', $url);
        $this->assertStringContainsString('text=people', $url);
    }

    /** @test */
    public function it_can_generate_product_image()
    {
        $url = $this->faker->imgenerateProduct(800, 600);

        $this->assertIsString($url);
        $this->assertStringContainsString('width=800', $url);
        $this->assertStringContainsString('height=600', $url);
    }

    /** @test */
    public function it_can_generate_background_image()
    {
        $url = $this->faker->imgenerateBackground(1920, 1080);

        $this->assertIsString($url);
        $this->assertStringContainsString('width=1920', $url);
        $this->assertStringContainsString('height=1080', $url);
    }

    /** @test */
    public function it_can_generate_thumbnail()
    {
        $url = $this->faker->imgenerateThumbnail(150);

        $this->assertIsString($url);
        $this->assertStringContainsString('width=150', $url);
        $this->assertStringContainsString('height=150', $url);
    }

    /** @test */
    public function it_can_generate_random_image()
    {
        $url = $this->faker->imgenerateRandom([400, 800], [300, 600]);

        $this->assertIsString($url);
        $this->assertStringContainsString('imgenerate.com', $url);
    }
}
