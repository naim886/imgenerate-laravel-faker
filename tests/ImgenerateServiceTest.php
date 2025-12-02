<?php

namespace Imgenerate\LaravelFaker\Tests;

use Imgenerate\LaravelFaker\Facades\Imgenerate;

class ImgenerateServiceTest extends TestCase
{
    /** @test */
    public function it_can_generate_image_url()
    {
        $url = Imgenerate::url();

        $this->assertIsString($url);
        $this->assertStringContainsString('imgenerate.com', $url);
    }

    /** @test */
    public function it_can_generate_image_url_with_dimensions()
    {
        $url = Imgenerate::url(800, 600);

        $this->assertIsString($url);
        $this->assertStringContainsString('800x600', $url);
    }

    /** @test */
    public function it_can_generate_image_url_with_category()
    {
        $url = Imgenerate::url(800, 600, 'nature');

        $this->assertIsString($url);
        $this->assertStringContainsString('nature', $url);
    }

    /** @test */
    public function it_can_chain_methods()
    {
        $url = Imgenerate::dimensions(1920, 1080)
            ->category('technology')
            ->get();

        $this->assertIsString($url);
        $this->assertStringContainsString('1920x1080', $url);
        $this->assertStringContainsString('technology', $url);
    }

    /** @test */
    public function it_can_generate_multiple_urls()
    {
        $urls = Imgenerate::multiple(3, 800, 600);

        $this->assertIsArray($urls);
        $this->assertCount(3, $urls);

        foreach ($urls as $url) {
            $this->assertIsString($url);
            $this->assertStringContainsString('imgenerate.com', $url);
        }
    }

    /** @test */
    public function it_returns_available_categories()
    {
        $categories = Imgenerate::categories();

        $this->assertIsArray($categories);
        $this->assertContains('nature', $categories);
        $this->assertContains('technology', $categories);
        $this->assertContains('people', $categories);
    }
}

