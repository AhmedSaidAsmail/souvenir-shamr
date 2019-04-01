<?php

namespace Uploading\Image;

use Illuminate\Http\UploadedFile;
use Closure;

class UploadFactory
{
    /**
     * @param array $attributes
     * @param string $key
     * @param $path
     * @param Closure $func
     * @return mixed
     */
    public function createImage(array $attributes, $key, $path, Closure $func)
    {
        $file = $this->dataHasKey($attributes, $key);
        if ($file && $file instanceof UploadedFile) {
            return $func((new UploadingImage($file, $path, $key)));
        }
    }

    private function dataHasKey(array $attributes, $key)
    {
        return array_key_exists($key, $attributes) ? $attributes[$key] : false;
    }

    /**
     * @param array $attributes
     * @param $key
     * @param $path
     * @param Closure $func
     */
    public function createMultipleImages(array &$attributes, $key, $path, Closure $func)
    {
        array_walk($attributes, function (&$attribute) use ($key, $path, $func) {
            if (is_array($attribute) && $attribute[$key] instanceof UploadedFile) {
                $attribute[$key] = $this->createImage($attribute, $key, $path, $func);
            }
        });
    }


}