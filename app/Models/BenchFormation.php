<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BenchFormation extends Authenticatable
{
    use Notifiable;

    protected $table = 'jud_bench_formation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $casts = ['id' => 'string'];

    protected $fillable = [
    ];
}
