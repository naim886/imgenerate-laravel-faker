<?php

namespace Imgenerate\LaravelFaker;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImgenerateService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var string|null
     */
    protected $category;

    /**
     * @var string
     */
    protected $disk;

    /**
     * @var string|null
     */
    protected $bg;

    /**
     * @var string|null
     */
    protected $textColor;

    /**
     * @var int|null
     */
    protected $fontSize;

    /**
     * @var int|null
     */
    protected $angle;

    /**
     * @var string|null
     */
    protected $text;

    /**
     * @var string|null
     */
    protected $format;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'timeout' => config('imgenerate.timeout', 30),
            'verify' => false,
        ]);

        $this->width = config('imgenerate.default_width', 640);
        $this->height = config('imgenerate.default_height', 480);
        $this->category = config('imgenerate.default_category', null);
        $this->disk = config('imgenerate.default_disk', 'public');
        $this->bg = config('imgenerate.default_bg', null);
        $this->textColor = config('imgenerate.default_text_color', null);
        $this->fontSize = config('imgenerate.default_font_size', null);
        $this->angle = config('imgenerate.default_angle', 0);
        $this->text = config('imgenerate.default_text', null);
        $this->format = config('imgenerate.default_format', null);
    }

    /**
     * Set image dimensions.
     *
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function dimensions(int $width, int $height): self
    {
        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    /**
     * Set image category.
     *
     * @param string|null $category
     * @return $this
     */
    public function category(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Set storage disk.
     *
     * @param string $disk
     * @return $this
     */
    public function disk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Set background color (hex code without #).
     *
     * @param string|null $bg
     * @return $this
     */
    public function bg(?string $bg): self
    {
        $this->bg = $bg;

        return $this;
    }

    /**
     * Set text color (hex code without #).
     *
     * @param string|null $textColor
     * @return $this
     */
    public function textColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    /**
     * Set font size.
     *
     * @param int|null $fontSize
     * @return $this
     */
    public function fontSize(?int $fontSize): self
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * Set text angle.
     *
     * @param int|null $angle
     * @return $this
     */
    public function angle(?int $angle): self
    {
        $this->angle = $angle;

        return $this;
    }

    /**
     * Set custom text.
     *
     * @param string|null $text
     * @return $this
     */
    public function text(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set image format.
     *
     * @param string|null $format
     * @return $this
     */
    public function format(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Generate image URL.
     *
     * @param int|null $width
     * @param int|null $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     */
    public function url(?int $width = null, ?int $height = null, array $options = []): string
    {
        $width = $width ?? $this->width;
        $height = $height ?? $this->height;

        $params = [
            'width' => $width,
            'height' => $height,
        ];

        // Add background color
        if (!empty($options['bg'])) {
            $params['bg'] = $options['bg'];
        } elseif ($this->bg) {
            $params['bg'] = $this->bg;
        }

        // Add text color
        if (!empty($options['text_color'])) {
            $params['text_color'] = $options['text_color'];
        } elseif ($this->textColor) {
            $params['text_color'] = $this->textColor;
        }

        // Add font size
        if (!empty($options['font_size'])) {
            $params['font_size'] = $options['font_size'];
        } elseif ($this->fontSize) {
            $params['font_size'] = $this->fontSize;
        }

        // Add angle
        if (isset($options['angle'])) {
            $params['angle'] = $options['angle'];
        } elseif ($this->angle !== null) {
            $params['angle'] = $this->angle;
        }

        // Add text
        if (!empty($options['text'])) {
            $params['text'] = $options['text'];
        } elseif ($this->text) {
            $params['text'] = $this->text;
        } elseif ($this->category) {
            $params['text'] = $this->category;
        }

        // Add format
        if (!empty($options['format'])) {
            $params['format'] = $options['format'];
        } elseif ($this->format) {
            $params['format'] = $this->format;
        }

        $queryString = http_build_query($params);

        return "https://imgenerate.com/generate?{$queryString}";
    }

    /**
     * Get image URL (alias for url method).
     *
     * @return string
     */
    public function get(): string
    {
        return $this->url();
    }

    /**
     * Download image content.
     *
     * @param int|null $width
     * @param int|null $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return string
     * @throws GuzzleException
     */
    public function download(?int $width = null, ?int $height = null, array $options = []): string
    {
        $url = $this->url($width, $height, $options);

        $response = $this->client->get($url);

        return $response->getBody()->getContents();
    }

    /**
     * Save image to storage.
     *
     * @param int|null $width
     * @param int|null $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @param string|null $path
     * @param string|null $filename
     * @return string
     * @throws GuzzleException
     */
    public function save(
        ?int $width = null,
        ?int $height = null,
        array $options = [],
        ?string $path = null,
        ?string $filename = null
    ): string {
        $width = $width ?? $this->width;
        $height = $height ?? $this->height;
        $path = $path ?? config('imgenerate.default_path', 'images');
        $filename = $filename ?? Str::random(40) . '.jpg';

        // Ensure filename has extension
        if (!str_contains($filename, '.')) {
            $filename .= '.jpg';
        }

        $fullPath = $path ? "{$path}/{$filename}" : $filename;

        $imageContent = $this->download($width, $height, $options);

        Storage::disk($this->disk)->put($fullPath, $imageContent);

        return $fullPath;
    }

    /**
     * Generate multiple image URLs.
     *
     * @param int $count
     * @param int|null $width
     * @param int|null $height
     * @param array $options Additional options: bg, text_color, font_size, angle, text, format
     * @return array
     */
    public function multiple(int $count, ?int $width = null, ?int $height = null, array $options = []): array
    {
        $images = [];

        for ($i = 0; $i < $count; $i++) {
            $images[] = $this->url($width, $height, $options);
        }

        return $images;
    }

    /**
     * Get available categories.
     *
     * @return array
     */
    public static function categories(): array
    {
        return [
            'abstract',
            'animals',
            'business',
            'cats',
            'city',
            'food',
            'nature',
            'nightlife',
            'people',
            'sports',
            'technology',
            'transport',
        ];
    }
}

