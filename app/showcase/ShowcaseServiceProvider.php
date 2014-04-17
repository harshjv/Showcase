<?php

namespace Showcase;

use Illuminate\Support\ServiceProvider;

class ShowcaseServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('showcase', function()
        {
            return new Showcase;
        });
    }

}