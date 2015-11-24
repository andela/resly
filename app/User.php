<?php

namespace Resly;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = [
    'fname',
    'lname',
    'username',
    'email',
    'avatar_url',
    'provider_id',
    'provider_name',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getAvatarUrl()
    {
        if (is_null($this->gravatarURL)) {
            return $this->avatarURL;
        }
    }
}
