<?php
/**
 * Created by PhpStorm.
 * User: jholc
 * Date: 20/09/16
 * Time: 1:43
 */

namespace Jampot5000\EloquentScientist;


use Illuminate\Support\Facades\Facade as BaseFacade;


class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'Scientist\Laboratory';
    }
}