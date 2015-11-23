<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function getAvatarUrl()
    {
        if (is_null($this->gravatarURL)) {
            return $this->avatarURL;
        }
    }
}
