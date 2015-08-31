<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 01/05/2015
 * Time: 19:52
 */

namespace Maverickslab\Shipeasy;


/**
 * Class InjectAPIRequester
 *
 * @package Maverickslab\Shipeasy
 */
trait InjectAPIRequester {
    /**
     * @var APIRequester
     */
    public $requester;

    /**
     * @param APIRequester $requester
     */
    public function __construct(APIRequester $requester){
        $this->requester = $requester;
    }
}