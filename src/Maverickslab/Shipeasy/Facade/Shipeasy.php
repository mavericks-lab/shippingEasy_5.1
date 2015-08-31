<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 06:56
 */

namespace Maverickslab\Shipeasy\Facade;


use Illuminate\Support\Facades\Facade;

class Shipeasy extends Facade {
    protected static function getFacadeAccessor() {
        return 'Shipeasy';
    }
}