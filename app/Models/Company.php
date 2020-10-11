<?php

namespace App\Models;

class Company extends BaseModel
{
    const UserRelationshipTable = 'company_user';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

    /**
     * Company users
     */
    public function users()
    {
        return $this
            ->belongsToMany(
                User::class,
                static::UserRelationshipTable,
                'company_id',
                'user_id'
            )
            ->withTimestamps();
    }
}
