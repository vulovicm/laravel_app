<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FriendshipTypeEntity
 * @package App
 */
class FriendshipTypeEntity extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function friendship()
    {
        return $this->belongsTo('App\Model\FriendshipEntity');
    }
}
