<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kalibrasi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'form_kalibrasi';

    protected $fillable = [
        'userID',
        'name',
        'date',
        'address',
        'nama_alat',
        'merek_alat',
        'serial_number_alat',
        'kapasitas',
        'area_kalibrasi',
        'file_pengajuan',
        'status',
        'berkas',
        'berkas_laporan',
        'berkas_analis',
        'user_confirm',
        'admin_confirm',
        'done_survey',
        'bukti_pembayaran_kalibrasi'
    ];
}
