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
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateUrl(int $width = 640, int $height = 480, array $options = []): string
    {
        return $this->service->url($width, $height, $options);
    }

    /**
     * Generate and save image to storage.
     *
     * @param int $width
     * @param int $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @param string|null $path
     * @return string
     * @throws GuzzleException
     */
    public function imgenerateSave(
        int $width = 640,
        int $height = 480,
        array $options = [],
        ?string $path = null
    ): string {
        return $this->service->save($width, $height, $options, $path);
    }

    /**
     * Generate random image with random dimensions.
     *
     * @param array $widthRange
     * @param array $heightRange
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateRandom(
        array $widthRange = [400, 1200],
        array $heightRange = [300, 900],
        array $options = []
    ): string {
        $width = $this->generator->numberBetween($widthRange[0], $widthRange[1]);
        $height = $this->generator->numberBetween($heightRange[0], $heightRange[1]);

        return $this->service->url($width, $height, $options);
    }

    /**
     * Generate square image URL.
     *
     * @param int $size
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateSquare(int $size = 500, array $options = []): string
    {
        return $this->service->url($size, $size, $options);
    }

    /**
     * Generate avatar image URL.
     *
     * @param int $size
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateAvatar(int $size = 200, array $options = []): string
    {
        if (empty($options['text'])) {
            $options['text'] = 'Avatar';
        }
        return $this->service->url($size, $size, $options);
    }

    /**
     * Generate product image URL.
     *
     * @param int $width
     * @param int $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateProduct(int $width = 800, int $height = 600, array $options = []): string
    {
        if (empty($options['text'])) {
            $options['text'] = 'Product';
        }
        return $this->service->url($width, $height, $options);
    }

    /**
     * Generate background image URL.
     *
     * @param int $width
     * @param int $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateBackground(int $width = 1920, int $height = 1080, array $options = []): string
    {
        if (empty($options['text'])) {
            $options['text'] = 'Background';
        }
        return $this->service->url($width, $height, $options);
    }

    /**
     * Generate thumbnail image URL.
     *
     * @param int $size
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function imgenerateThumbnail(int $size = 150, array $options = []): string
    {
        return $this->service->url($size, $size, $options);
    }
}

