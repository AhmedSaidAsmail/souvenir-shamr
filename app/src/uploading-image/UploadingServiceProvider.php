<?php

namespace Uploading\Image;


use Illuminate\Support\ServiceProvider;

class UploadingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('upload', function () {
            return new UploadFactory();
        });

    }

}