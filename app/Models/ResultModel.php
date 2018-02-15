<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    protected $table = 'result';

    protected $fillable = ['name', 'shooter_id', 'event_id', 'competition', 'results', 'point_sum', 'time_sum'];

    public static $rules = [
        'name' => 'required|max:255',
        'shooter_id' => 'required|integer',
        'event_id' => 'required|integer',
        'competition' => 'required|integer',
        'results' => 'required|json',
        'point_sum' => 'numeric',
        'time_sum' => 'nullable|numeric'
    ];

    public function event()
    {
        return $this->hasOne('App\Models\EventModel', 'event_id');
    }

    public function shooter()
    {
        return $this->hasOne('App\Models\ShooterModel', 'shooter_id');
    }

}
