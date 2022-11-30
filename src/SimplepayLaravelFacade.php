<?php

namespace zoparga\SimplePayLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zoparga\SimplePayLaravel\Skeleton\SkeletonClass
 */
class SimplePayLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simplepay-laravel';
    }
}
