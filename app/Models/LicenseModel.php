<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseModel extends Model
{
    protected $table = 'license';

    protected $fillable = ['name', 'surname', 'club_id'];

    public static $rules = [
        'name' => 'required|max:50',
        'surname' => 'required|max:50',
        'club_id' => 'nullable|integer'
    ];

    public function shooter()
    {
        return $this->hasOne('App\Models\ShooterModel', 'shooter_id');
    }

}
