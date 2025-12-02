<?php

namespace Imgenerate\LaravelFaker;

use Faker\Provider\Base;
use GuzzleHttp\Exception\GuzzleException;

class FakerProvider extends Base
{
    /**
     * @var ImgenerateService
     */
    protected $service;

    /**
     * Constructor.
     *
     * @param \Faker\Generator $generator
     */
    public function __construct(\Faker\Generator $generator)
    {
        parent::__construct($generator);
        $this->service = new ImgenerateService();
    }

    /**
     * Generate image URL.
     *
     * @param int $width
     * @param int $height
     * @param string|null $category
     * @return string
     */
    public function imgenerateUrl(int $width = 640, int $height = 480, ?string $category = null): string
    {
        return $this->service->url($width, $height, $category);
    }

    /**
     * Generate and save image to storage.
     *
     * @param int $width
     * @param int $height
     * @param string|null $category
     * @param string|null $path
     * @return string
     * @throws GuzzleException
     */
    public function imgenerateSave(
        int $width = 640,
        int $height = 480,
        ?string $category = null,
        ?string $path = null
    ): string {
        return $this->service->save($width, $height, $category, $path);
    }

    /**
     * Generate random image with random dimensions.
     *
     * @param array $widthRange
     * @param array $heightRange
     * @param string|null $category
     * @return string
     */
    public function imgenerateRandom(
        array $widthRange = [400, 1200],
        array $heightRange = [300, 900],
        ?string $category = null
    ): string {
        $width = $this->generator->numberBetween($widthRange[0], $widthRange[1]);
        $height = $this->generator->numberBetween($heightRange[0], $heightRange[1]);

        return $this->service->url($width, $height, $category);
    }

    /**
     * Generate square image URL.
     *
     * @param int $size
     * @param string|null $category
     * @return string
     */
    public function imgenerateSquare(int $size = 500, ?string $category = null): string
    {
        return $this->service->url($size, $size, $category);
    }

    /**
     * Generate avatar image URL.
     *
     * @param int $size
     * @return string
     */
    public function imgenerateAvatar(int $size = 200): string
    {
        return $this->service->url($size, $size, 'people');
    }

    /**
     * Generate product image URL.
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public function imgenerateProduct(int $width = 800, int $height = 600): string
    {
        $categories = ['food', 'technology', 'business'];
        $category = $categories[array_rand($categories)];

        return $this->service->url($width, $height, $category);
    }

    /**
     * Generate background image URL.
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public function imgenerateBackground(int $width = 1920, int $height = 1080): string
    {
        $categories = ['nature', 'abstract', 'city'];
        $category = $categories[array_rand($categories)];

        return $this->service->url($width, $height, $category);
    }

    /**
     * Generate thumbnail image URL.
     *
     * @param int $size
     * @param string|null $category
     * @return string
     */
    public function imgenerateThumbnail(int $size = 150, ?string $category = null): string
    {
        return $this->service->url($size, $size, $category);
    }
}

