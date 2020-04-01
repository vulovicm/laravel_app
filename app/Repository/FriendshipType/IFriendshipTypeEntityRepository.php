<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 7:01 PM
 */

namespace App\Repository\FriendshipType;

/**
 * Interface IFriendshipTypeEntityRepository
 * @package App\Repository\FriendshipType
 */
interface IFriendshipTypeEntityRepository
{
    /**
     * Get's a friendship type by it's ID
     *
     * @param int
     */
    public function get($friendship_type_id);

    /**
     * Get's all friendship types.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a friendship type.
     *
     * @param int
     */
    public function delete($friendship_type_id);

    /**
     * Updates a friendship type.
     *
     * @param int
     * @param array
     */
    public function update($friendship_type_id, array $friendship_type_data);

    /**
     * @return mixed
     */
    public function getSendRequestType();

    /**
     * @return mixed
     */
    public function getAcceptRequestType();

    /**
     * @return mixed
     */
    public function getCancelRequestType();

    /**
     * @return mixed
     */
    public function getRejectRequestType();
}