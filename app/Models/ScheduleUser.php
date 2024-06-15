<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleUser extends Model
{
    use HasFactory;

    protected $table = 'schedule_users';


    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
        'created_at',
        'updated_at',
    ];

    const STATUS = [
        1 => 'Pending',
        2 => 'Approved'
    ];

    public function user()
    {
        return $this->hasOne(Customer::class, 'id', 'user_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'submit']);
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
