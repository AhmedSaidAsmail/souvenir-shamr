<?php

namespace Uploading\Image;

use Illuminate\Http\UploadedFile;

class Uploading
{
    public function __construct()
    {
    }

    public function upload(UploadedFile $image, $path, array $resolutions)
    {

    }

    private function newBuilder()
    {
        return new Builder();
    }

    public function __call($method, $arguments)
    {
        return $this->newBuilder()->$method($arguments);

    }

}