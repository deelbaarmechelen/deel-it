<?php

namespace Deelbaarmechelen\DeelIt;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Deelbaarmechelen\DeelIt\Skeleton\SkeletonClass
 */
class DeelItFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'deel-it';
    }
}
