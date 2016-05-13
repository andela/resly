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

    /**
     * Check whether the time set for a resevation,
     * is within the next 15 minutes.
     *
     * @return Return TRUE or FALSE.
     */
    public function isSoon($timeOff)
    {
        $timeLeft = $this->timeLeft($timeOff);
        return ($timeLeft / 60) < 15 && $timeLeft > 0;
    }

    /**
     * Get the time left for a reservation to be due.
     * The value is in seconds.
     *
     * @return The time left before a reservation is due, inseconds.
     */
    private function timeLeft($timeOff)
    {
        $now = strtotime($timeOff);
        $scheduled_date = strtotime($this->scheduled_date);
        $time_left = $scheduled_date - $now;

        return $time_left;
    }

    /**
     * Check if a reservation has passed.
     *
     * @return TRUE OR FALSE
     */
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
