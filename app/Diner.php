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
        'username',
        'email',
        'password',
        'confirm-password',
        'name',
        'social_id',
        'avatar',
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

    /**
     * Persist the photo to the database .
     */
    public function addPhotos(DinerPhoto $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * Get the photos associated with the diner.
     */
    public function photos()
    {
        return $this->hasMany('Resly\DinerPhoto');
    }

    /**
     * Get the diner with the unique username.
     */
    public static function dinerWithUsername($username)
    {
        return static::whereUsername($username)->firstOrFail();
    }
}
