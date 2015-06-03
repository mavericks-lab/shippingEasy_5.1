<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 21:31
 */

namespace Maverickslab\Shipeasy;


class Helpers {
    public function sanitizeArray($array){
        foreach ($array as $key => &$value) {
            if(is_array($value)) $this->sanitizeArray($value);

            if(is_null($value)) unset($array[$key]);
        }

        return $array;
    }
}