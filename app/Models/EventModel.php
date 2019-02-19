<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';

    protected $fillable = ['name', 'date'];

    public static $rules = [
        'name' => 'required|max:255',
        'date' => 'required|date|date_format:Y-m-d'
    ];



}
