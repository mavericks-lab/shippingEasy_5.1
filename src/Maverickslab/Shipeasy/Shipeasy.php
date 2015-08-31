<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 06:29
 */

namespace Maverickslab\Shipeasy;


/**
 * Class Shippingeasy
 *
 * @package Maverickslab\Shipeasy
 */
class Shipeasy {
    use InjectAPIRequester;

    /**
     * dynamically resolve classes on the facade
     * @param $method
     * @param $args
     *
     * @return mixed
     * @throws Exception
     */
    public function __call($method, $args){
        $class = self::normalize($method);
        return self::resolve($class);
    }

    /**
     * creates an instance of the class' "method"
     * @param $class_name
     *
     * @return mixed
     * @throws Exception
     */
    public function resolve($class_name){
        if(class_exists($class_name))
            return new $class_name($this->requester);

        throw new Exception("{$class_name} not found");
    }

    /**
     * normalize ths class' name
     * @param $class_name
     *
     * @return string
     */
    public function normalize($class_name){
        return __NAMESPACE__.'\\'.ucfirst(strtolower($class_name));
    }

}