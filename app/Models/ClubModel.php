<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubModel extends Model
{
    protected $table = 'club';

    protected $fillable = ['name', 'license_no'];

    public static $rules = [
        'name' => 'required|max:50',
        'license_no' => 'nullable|unique:club|max:30',
    ];

    public function shooters()
    {
        return $this->hasMany('App\Models\Shooter', 'club_id');
    }

}
