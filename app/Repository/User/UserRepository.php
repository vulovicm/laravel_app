<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 4:30 PM
 */

namespace App\Repository\User;

use App\Model\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository implements IUserRepositoryInterface
{
    /**
     * Get's a user by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($user_id)
    {
        return User::find($user_id);
    }

    /**
     * Get's all users.
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Deletes a user.
     *
     * @param int
     */
    public function delete($user_id)
    {
        User::destroy($user_id);
    }

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data)
    {
        User::find($user_id)->update($user_data);
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     */
    public function save($name, $email, $password)
    {
        /** @var User $user */
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => $password]);

        $user->save();;
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function ifUserExists($user_id)
    {
        $user = DB::table('users')
            ->where('id', 'LIKE', $user_id)
            ->first();

        return $user;
    }
}