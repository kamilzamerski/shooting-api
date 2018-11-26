<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShooterModel extends Model
{
    protected $table = 'shooter';

    protected $fillable = ['name', 'surname', 'club_id'];

    public static $rules = [
        'name' => 'required|max:50',
        'surname' => 'required|max:50',
        'club_id' => 'nullable|integer'
    ];

    public function licenses()
    {
        return $this->hasMany('App\Models\LicenseModel', 'shooter_id');
    }

    public function club()
    {
        return $this->hasOne('App\Models\ClubModel', 'club_id');
    }

    public static function create($name, $surname, $club_id)
    {
        $objModel = new static();
        $objModel->name = $name;
        $objModel->surname = $surname;
        $objModel->club_id = $club_id;
        $objModel->save();
        return $objModel;
    }

}
