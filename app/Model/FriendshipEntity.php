<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FriendshipEntity
 * @package App
 */
class FriendshipEntity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_id', 'addresse_id', 'friendship_type_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friendshipTypes()
    {
        return $this->hasMany('App\Model\FriendshipTypeEntity');
    }
}
