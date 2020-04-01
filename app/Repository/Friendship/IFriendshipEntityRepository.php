<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 5:43 PM
 */

namespace App\Repository\Friendship;

/**
 * Interface IFriendshipEntityRepository
 * @package App\Repository
 */
interface IFriendshipEntityRepository
{
    /**
     * Get's a friendship by it's ID
     *
     * @param int
     */
    public function get($friendship_id);

    /**
     * Get's all friendships.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a friendship.
     *
     * @param int
     */
    public function delete($friendship_id);

    /**
     * Updates a friendship.
     * @param $friendship_id
     * @param $friendship_type_id
     * @return
     */
    public function update($friendship_id, $friendship_type_id);

    /**
     * Updates a friendship.
     * @param $loggedin_user_id
     * @param $addresse_id
     * @param $friendship_type_id
     * @return
     */
    public function create($loggedin_user_id, $addresse_id , $friendship_type_id);

    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return mixed
     */
    public function sendRequestCheckRelation($loggedin_user_id,$addresse_id);

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return mixed
     */
    public function sendRequestCheckRelationReverse($addresse_id,$loggedin_user_id);


    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return mixed
     */
    public function canSendFriendRequest($loggedin_user_id,$addresse_id);


    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return mixed
     */
    public function acceptRequestCheckRelation($addresse_id,$loggedin_user_id);


    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return mixed
     */
    public function canAcceptRequestCheckRelation($addresse_id, $loggedin_user_id);

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function relationDoesNotExits();

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function rejectAndCancelRequestCheckRelation($addresse_id, $loggedin_user_id);

    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function canRejectAndCancelRequestCheckRelation($loggedin_user_id,$addresse_id);

}