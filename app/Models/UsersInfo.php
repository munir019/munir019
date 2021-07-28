<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsersInfo extends Authenticatable
{
    use Notifiable;

    protected $table = 'news_user_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $casts = ['id' => 'string'];

    protected $fillable = [
    ];
}
