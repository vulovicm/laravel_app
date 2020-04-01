<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 9:50 AM
 */

namespace App\Http\ControllerProcessor;

/**
 * Interface IFriendshipControllerProcessor
 * @package App\Http\ControllerProcessor
 */
interface IFriendshipControllerProcessor
{
    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleSendRequest($user_id);

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleAcceptRequest($user_id);

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleRejectRequest($user_id);

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleCancelRequest($user_id);

}