<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use Notifiable;

        protected $guard = 'seller';
        protected $table = 'seller';

        protected $fillable = [
            'name', 'email', 'mobile', 'password','user_role'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
