<?php

namespace Showcase\Facades;

use Illuminate\Support\Facades\Facade;

class ShowcaseFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'showcase'; }

}