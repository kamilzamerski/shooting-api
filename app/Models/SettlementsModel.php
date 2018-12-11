<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettlementsModel extends Model
{
    protected $table = 'settlements';

    protected $fillable = ['member_id', 'description', 'amount', 'year'];

    public static $rules = [
        'member_id' => 'integer',
        'year' => 'integer',
        'amount' => 'numeric'
    ];

    public function member()
    {
        return $this->hasOne('App\Models\MemberModel', 'id', 'member_id');
    }

    /**
     * @param int $member_id
     * @param int $year
     * @param string $description
     * @param float $amount
     * @return SettlementsModel
     */
    public static function create(int $member_id, int $year, string $description, float $amount)
    {
        $objModel = new static();
        $objModel->description = $description;
        $objModel->amount = $amount;
        $objModel->year = $year;
        $objModel->member_id = $member_id;
        $objModel->save();
        return $objModel;
    }

}
