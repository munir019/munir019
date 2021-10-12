<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CourtInfo extends Authenticatable
{
    use Notifiable;

    protected $table = 'jud_court_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /*protected $casts = ['id' => 'string'];*/

    protected $fillable = [
    ];
}
