<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

abstract class BaseModel extends Model
{
    use HasFactory, Notifiable;

    public int $id;
    public string $name;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 100;
}
