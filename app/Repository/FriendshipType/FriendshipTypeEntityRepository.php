<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 7:01 PM
 */

namespace App\Repository\FriendshipType;

use App\Model\FriendshipTypeEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class FriendshipTypeEntityRepository
 * @package App\Repository
 */
class FriendshipTypeEntityRepository implements IFriendshipTypeEntityRepository
{
    /**
     * Get's a friendship by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($friendship_type_id)
    {
        return FriendshipTypeEntity::find($friendship_type_id);
    }

    /**
     * Get's all friendship types.
     *
     * @return mixed
     */
    public function all()
    {
        return FriendshipTypeEntity::all();
    }

    /**
     * Deletes a friendship type.
     *
     * @param int
     */
    public function delete($friendship_type_id)
    {
        FriendshipTypeEntity::destroy($friendship_type_id);
    }

    /**
     * Updates a friendship type.
     *
     * @param int
     * @param array
     */
    public function update($friendship_type_id, array $friendship_type_data)
    {
        FriendshipTypeEntity::find($friendship_type_id)->update($friendship_type_data);
    }

    public function getSendRequestType()
    {
        $relation_check = DB::table('friendship_type_entities')
            ->where('friendship_type_entities.id', 'LIKE', 1)
            ->first();

        return $relation_check;
    }

    public function getAcceptRequestType()
    {
        $relation_check = DB::table('friendship_type_entities')
            ->where('friendship_type_entities.id', 'LIKE', 2)
            ->first();

        return $relation_check;
    }

    public function getCancelRequestType()
    {
        $relation_check = DB::table('friendship_type_entities')
            ->where('friendship_type_entities.id', 'LIKE', 3)
            ->first();

        return $relation_check;
    }

    public function getRejectRequestType()
    {
        $relation_check = DB::table('friendship_type_entities')
            ->where('friendship_type_entities.id', 'LIKE', 4)
            ->first();

        return $relation_check;
    }
}