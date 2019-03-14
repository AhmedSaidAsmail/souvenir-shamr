<?php

namespace Sync\HasMany;

use Illuminate\Support\ServiceProvider;

class SyncServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('sync', function () {
            return new Sync();
        });
    }
}