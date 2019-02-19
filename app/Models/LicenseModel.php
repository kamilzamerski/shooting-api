<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseModel extends Model
{
    protected $table = 'license';

    protected $fillable = ['number', 'year', 'shooter_id'];

    public static $rules = [
        'number' => 'required|max:50',
        'year' => 'integer'
    ];

    public function shooter()
    {
        return $this->hasOne('App\Models\ShooterModel', 'id', 'shooter_id');
    }

    public static function create($number, $year, int $shooter_id)
    {
        $objModel = new static();
        $objModel->number = $number;
        $objModel->year = $year;
        $objModel->shooter_id = $shooter_id;
        $objModel->save();
        return $objModel;
    }

}
