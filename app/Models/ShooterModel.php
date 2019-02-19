<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShooterModel extends Model
{
    protected $table = 'shooter';

    protected $fillable = ['name', 'license_no', 'club_id'];

    public static $rules = [
        'name' => 'required|max:50',
        'license_no' => 'nullable|unique:shooter|max:30',
        'club_id' => 'nullable|integer'
    ];

    public function club()
    {
        return $this->hasOne('App\Models\ClubModel', 'club_id');
    }

}
