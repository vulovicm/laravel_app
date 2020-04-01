<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 4:29 PM
 */

namespace App\Repository\User;

/**
 * Interface IUserRepositoryInterface
 * @package App\Repository
 */
interface IUserRepositoryInterface
{
    /**
     * Get's a user by it's ID
     *
     * @param int
     */
    public function get($user_id);

    /**
     * Get's all users.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a user.
     *
     * @param int
     */
    public function delete($user_id);

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data);

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return mixed
     */
    public function save($name, $email, $password);

    /**
     * @param $user_id
     * @return mixed
     */
    public function ifUserExists($user_id);
}