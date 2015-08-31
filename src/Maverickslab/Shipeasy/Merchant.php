<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 20:05
 */

namespace Maverickslab\Shipeasy;


/**
 * Class Merchant
 *
 * @package Maverickslab\Shipeasy
 */
class Merchant
{
    use InjectAPIRequester;

    /**
     * create a merchant account on shipping easy for a merchant
     *
     * @param $merchant_data
     *
     * @return string
     */
    public function enroll($merchant)
    {
        return $this->requester->request('POST', '/partners/api/accounts', [
            'account' => $merchant
        ]);
    }
}