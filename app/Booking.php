<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'duration',
        'scheduled_date',
        'user_id',
        'table_id',
        'cost',
        'type',
        'is_cancelled',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('Resly\User', 'user_id');
    }

    public function refund()
    {
        return $this->hasOne('Resly\Refund');
    }

    public function isSoon()
    {
        $timeLeft = $this->timeLeft();
        return ($timeLeft / 60) < 15;
    }

    public function timeLeft()
    {
        $scheduled_date = strtotime($this->scheduled_date);
        $now = strtotime(date('Y-m-d H:m:s'));
        return $time_left = $scheduled_date - $now;
    }

    public function hasPassed()
    {
        return $this->timeLeft() < 0;
    }

    public function table()
    {
        return $this->belongsTo('Resly\Table');
    }

    public function restaurant()
    {
        $table = Table::find($this->table_id);
        $restaurant = Restaurant::find($table->restaurant_id);

        return $restaurant;
    }
}
