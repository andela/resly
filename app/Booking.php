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

    public function isSoon($timeOff)
    {
        $timeLeft = $this->timeLeft($timeOff);
        return ($timeLeft / 60) < 15 && $timeLeft > 0;
    }

    private function timeLeft($timeOff)
    {

        $now = strtotime($timeOff);
        $scheduled_date = strtotime($this->scheduled_date);
        $time_left = $scheduled_date - $now;
        return $time_left;
    }

    public function hasPassed($timeOff)
    {
        return $this->timeLeft($timeOff) < 0;
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
