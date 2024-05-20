<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Commodity extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'master_commodity';

    protected $fillable = [
        'kode',
        'keterangan',
    ];
}
