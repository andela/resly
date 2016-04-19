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
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('Resly\User', 'user_id');
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

    public function scopeConflictBooking($query, $tableId, $bookingDate, $bookingDuration)
    {
        return $query->where('table_id', '=', $tableId)
                    ->where(function ($query) use ($bookingDate) {
                            $query->where('scheduled_date', '<=', $bookingDate)
                                  ->whereRaw('(scheduled_date + INTERVAL `duration` HOUR) > ?', [$bookingDate]);
                    })
                    ->whereRaw('(? - (`scheduled_date` + INTERVAL `duration` HOUR)) < ?', [$bookingDate, $bookingDuration]);
    }
}
