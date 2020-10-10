<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    static function getModelClass()
    {
        return User::class;
    }
}
