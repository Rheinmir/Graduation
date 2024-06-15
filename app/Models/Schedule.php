<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';


    protected $fillable = [
        'title',
        'schedule_date',
        'contents',
        'status',
        'created_at',
        'updated_at',
    ];

    const STATUS = [
        1 => 'Active',
        2 => 'Closed',
    ];

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

    public function users()
    {
        return $this->hasMany(ScheduleUser::class, 'schedule_id', 'id');
    }
}
