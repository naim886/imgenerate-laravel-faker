<?php

namespace Imgenerate\LaravelFaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Imgenerate\LaravelFaker\ImgenerateService dimensions(int $width, int $height)
 * @method static \Imgenerate\LaravelFaker\ImgenerateService category(?string $category)
 * @method static \Imgenerate\LaravelFaker\ImgenerateService disk(string $disk)
 * @method static string url(?int $width = null, ?int $height = null, ?string $category = null)
 * @method static string get()
 * @method static string download(?int $width = null, ?int $height = null, ?string $category = null)
 * @method static string save(?int $width = null, ?int $height = null, ?string $category = null, ?string $path = null, ?string $filename = null)
 * @method static array multiple(int $count, ?int $width = null, ?int $height = null, ?string $category = null)
 * @method static array categories()
 *
 * @see \Imgenerate\LaravelFaker\ImgenerateService
 */
class Imgenerate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'imgenerate';
    }
}

