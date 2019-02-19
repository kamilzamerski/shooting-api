<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'name',
        'surname',
        'login',
        'password',
        'last_login_at',
    ];

    public static $rules = [
        'name' => 'required|max:50',
        'surname' => 'required|max:50',
        'login' => 'required|email|max:50',
        'password' => 'required|max:64',
    ];

}
