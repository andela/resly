<?php

namespace Resly;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;

class Diner extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Diner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'confirm-password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'confirm-password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->fname) {
            return $this->fname;
        } elseif ($this->lname) {
            return $this->lname;
        }

        return;
    }

    public function getDinerName()
    {
        return $this->getName();
    }

    public function bookings()
    {
        return $this->hasMany('Resly\Booking');
    }
}
