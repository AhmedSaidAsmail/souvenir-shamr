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
        $file = $file = $this->dataHasKey($attributes, $key);
        if ($file && $file instanceof UploadedFile) {
            return $func((new UploadingImage($file, $path,$key)));
        }
    }

    private function dataHasKey(array $attributes, $key)
    {
        return array_key_exists($key, $attributes) ? $attributes[$key] : false;
    }


}