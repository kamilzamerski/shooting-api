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

    public function shooter()
    {
        return $this->hasOne('App\Models\ShooterModel', 'shooter_id');
    }

    public static function create(array $request, int $shooter_id)
    {
        $objModel = new static();
        $objModel->name = $request['name'];
        $objModel->surname = $request['surname'];
        $objModel->date_of_join = $request['date_of_join'];
        $objModel->pesel = $request['pesel'];
        $objModel->address_street = $request['address_street'];
        $objModel->address_street_no = $request['address_street_no'];
        $objModel->address_apartment_no = $request['address_apartment_no'];
        $objModel->post_code = $request['post_code'];
        $objModel->city = $request['city'];
        $objModel->shooting_license = $request['shooting_license'];
        $objModel->email = $request['email'];
        $objModel->phone = $request['phone'];
        $objModel->active_to = $request['active_to'] ? $request['active_to'] : null;
        $objModel->shooter_id = $shooter_id;
        $objModel->save();
        return $objModel;
    }

}
