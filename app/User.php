<?php

namespace Resly;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Billable;

    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'password',
        'role',
        'avatar_url',
        'provider_id',
        'provider_name',
        'stripe_id',
        'card_brand',
        'card_last_four',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getAvatarUrl()
    {
        if (is_null($this->gravatarURL)) {
            return $this->avatar_url;
        }
    }

    /**
     *  Define a one to one restaurant relationship.
     */
    public function restaurant()
    {
        return $this->hasOne('Resly\Restaurant');
    }

    /**
     *  Get the role of the user.
     *
     *@return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Users have a 1-many refunds relationship.
     */
    public function refunds()
    {
        return $this->hasMany('Resly\Refund');
    }

    /**
     * Get the total credit-refunds that the user has.
     *
     * @return float
     */
    public function totalRefund()
    {
        return $this->refunds()->sum('credits');
    }

    /**
     *  Diner users have a 1-many bookings relationship.
     */
    public function bookings()
    {
        return $this->hasMany('Resly\Booking');
    }
}
