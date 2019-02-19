<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table = 'member';

    protected $fillable = [
        'name',
        'surname',
        'date_of_join',
        'pesel',
        'address_street',
        'address_street_no',
        'address_apartment_no',
        'post_code',
        'city',
        'shooting_license',
        'email',
        'phone',
        'active_to'
    ];

    public static $rules = [
        'name' => 'required|max:50',
        'surname' => 'required|max:50',
        'date_of_join' => 'required|date|dateFormat:Y-m-d',
        'pesel' => 'required|digits:11',
        'address_street' => 'nullable|max:50',
        'address_street_no' => 'nullable|max:10',
        'address_apartment_no' => 'nullable|max:10',
        'post_code' => 'nullable|min:6|max:6',
        'city' => 'nullable|max:50',
        'shooting_license' => 'nullable|max:20',
        'email' => 'nullable|email|max:50',
        'phone' => 'nullable|max:50',
        'active_to' => 'nullable|date|dateFormat:Y-m-d',
    ];

}
