<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 5:43 PM
 */

namespace App\Repository\Friendship;

use App\Model\FriendshipEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class FriendshipEntityRepository
 * @package App\Repository\Friendship
 */
class FriendshipEntityRepository implements IFriendshipEntityRepository
{
    /**
     * Get's a friendship by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($friendship_id)
    {
        return FriendshipEntity::find($friendship_id);
    }

    /**
     * Get's all friendships.
     *
     * @return mixed
     */
    public function all()
    {
        return FriendshipEntity::all();
    }

    /**
     * Deletes a friendship.
     *
     * @param int
     */
    public function delete($friendship_id)
    {
        FriendshipEntity::destroy($friendship_id);
    }

    /**
     * Updates a friendship.
     * @param $friendship_id
     * @param $friendship_type_id
     */
    public function update($friendship_id, $friendship_type_id)
    {
        /** @var FriendshipEntity $relation1 */
        $relation = $this->get($friendship_id);
        $relation->friendship_type_id = $friendship_type_id;

        $relation->save();
    }

    /**
     * Updates a friendship.
     * @param $loggedin_user_id
     * @param $addresse_id
     * @param $friendship_type_id
     */
    public function create($loggedin_user_id, $addresse_id, $friendship_type_id)
    {
        $relation = new FriendshipEntity([
            'requester_id' => $loggedin_user_id,
            'addresse_id' => intval($addresse_id),
            'friendship_type_id' => $friendship_type_id]);

        $relation->save();
    }

    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function sendRequestCheckRelation($loggedin_user_id, $addresse_id)
    {
        $relation_check = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $loggedin_user_id)
            ->where('addresse_id', 'LIKE', $addresse_id)
            ->where('friendship_type_id', 'LIKE', 1)
            ->orWhere('friendship_type_id', 'LIKE', 2)
            ->first();

        return $relation_check;
    }

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function sendRequestCheckRelationReverse($addresse_id, $loggedin_user_id)
    {
        $relation_check_reverse = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $addresse_id)
            ->where('addresse_id', 'LIKE', $loggedin_user_id)
            ->where('friendship_type_id', 'LIKE', 1)
            ->orWhere('friendship_type_id', 'LIKE', 2)
            ->first();

        return $relation_check_reverse;
    }

    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function canSendFriendRequest($loggedin_user_id, $addresse_id)
    {
        $relation = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $loggedin_user_id)
            ->where('addresse_id', 'LIKE', $addresse_id)
            ->where('friendship_type_id', 'LIKE', 3)
            ->orWhere('friendship_type_id', 'LIKE', 4)
            ->first();

        return $relation;
    }

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function acceptRequestCheckRelation($addresse_id, $loggedin_user_id)
    {
        $relation_check = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $addresse_id)
            ->where('addresse_id', 'LIKE', $loggedin_user_id)
            ->where('friendship_type_id', 'LIKE', 3)
            ->orWhere('friendship_type_id', 'LIKE', 2)
            ->orWhere('friendship_type_id', 'LIKE', 4)
            ->first();

        return $relation_check;
    }

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function canAcceptRequestCheckRelation($addresse_id, $loggedin_user_id)
    {
        $relation = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $addresse_id)
            ->where('addresse_id', 'LIKE', $loggedin_user_id)
            ->where('friendship_type_id', 'LIKE', 1)
            ->first();

        return $relation;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function relationDoesNotExits()
    {
        return response('Relation does not exists', 404);
    }

    /**
     * @param $addresse_id
     * @param $loggedin_user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|\Illuminate\Http\Response|null|object
     */
    public function rejectAndCancelRequestCheckRelation($addresse_id, $loggedin_user_id)
    {
        $relation = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $addresse_id)
            ->where('addresse_id', 'LIKE', $loggedin_user_id)
            ->where('friendship_type_id', 'LIKE', 3)
            ->orWhere('friendship_type_id', 'LIKE', 2)
            ->orWhere('friendship_type_id', 'LIKE', 4)
            ->first();

        return $relation;
    }

    /**
     * @param $loggedin_user_id
     * @param $addresse_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function canRejectAndCancelRequestCheckRelation($loggedin_user_id, $addresse_id)
    {
        $relation =
        $relation = DB::table('friendship_entities')
            ->where('requester_id', 'LIKE', $loggedin_user_id)
            ->where('addresse_id', 'LIKE', $addresse_id)
            ->where('friendship_type_id', 'LIKE', 1)
            ->first();

        return $relation;
    }
}