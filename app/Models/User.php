<?php

namespace App\Models;

class User extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';


    /**
     * Company users
     */
    public function companies()
    {
        return $this
            ->belongsToMany(
                Company::class,
                Company::UserRelationshipTable,
                'user_id',
                'company_id'
            )
            ->withTimestamps();
    }
}
