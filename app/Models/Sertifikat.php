<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Sertifikat extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'data_sertifikat';

    protected $fillable = [
        'kepala_dinas',
        'nip',
        'kepala_bpsmb',
        'nip_bpsmb',
        'technical_manager',
        'nip_manager',
        'no_lab'
    ];
}
