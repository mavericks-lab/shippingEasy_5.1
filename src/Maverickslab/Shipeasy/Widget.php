<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 21:16
 */

namespace Maverickslab\Shipeasy;


/**
 * Class Widget
 *
 * @package Maverickslab\Shipeasy
 */
class Widget {
    use InjectAPIRequester;


    /** generate a session for the widget
     * @param $session
     *
     * @return string
     */
    public function session($session)
    {
        $session['single_use'] = false;
        $session['lifetime_in_seconds'] = 1800;

        return $this->requester->request('POST', '/partners/api/sessions', [
            'session' => $session
        ]);
    }
}