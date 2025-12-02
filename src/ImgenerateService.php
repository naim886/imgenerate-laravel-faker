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
     * Generate image URL.
     *
     * @param int|null $width
     * @param int|null $height
     * @param string|null $category
     * @return string
     */
    public function url(?int $width = null, ?int $height = null, ?string $category = null): string
    {
        $width = $width ?? $this->width;
        $height = $height ?? $this->height;
        $category = $category ?? $this->category;

        $params = [
            'width' => $width,
            'height' => $height,
        ];

        if ($category) {
            $params['text'] = $category;
        }

        // Add random parameter to avoid caching
        $params['random'] = Str::random(10);

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
     * @param string|null $category
     * @return string
     * @throws GuzzleException
     */
    public function download(?int $width = null, ?int $height = null, ?string $category = null): string
    {
        $url = $this->url($width, $height, $category);

        $response = $this->client->get($url);

        return $response->getBody()->getContents();
    }

    /**
     * Save image to storage.
     *
     * @param int|null $width
     * @param int|null $height
     * @param string|null $category
     * @param string|null $path
     * @param string|null $filename
     * @return string
     * @throws GuzzleException
     */
    public function save(
        ?int $width = null,
        ?int $height = null,
        ?string $category = null,
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

        $imageContent = $this->download($width, $height, $category);

        Storage::disk($this->disk)->put($fullPath, $imageContent);

        return $fullPath;
    }

    /**
     * Generate multiple image URLs.
     *
     * @param int $count
     * @param int|null $width
     * @param int|null $height
     * @param string|null $category
     * @return array
     */
    public function multiple(int $count, ?int $width = null, ?int $height = null, ?string $category = null): array
    {
        $images = [];

        for ($i = 0; $i < $count; $i++) {
            $images[] = $this->url($width, $height, $category);
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

