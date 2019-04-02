<?php

namespace Matrix\Image;


use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('matrix.image', function () {
            return new ImageFacade(new Image());
        });
    }

}