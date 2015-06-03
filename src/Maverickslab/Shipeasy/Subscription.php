<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 07:28
 */

namespace Maverickslab\Shipeasy;


/**
 * Class Subscription
 *
 * @package Maverickslab\Shipeasy
 */
class Subscription {
    use InjectAPIRequester;

    /**
     * get all subscriptions from shipping easy
     * @return string
     */
    public function get(){
        return $this->requester->request('GET', '/partners/api/subscription_plans');
    }
}