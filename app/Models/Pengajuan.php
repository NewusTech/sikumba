<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengajuan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'form_pengajuan';

    protected $fillable = [
        'userID',
        'name',
        'date',
        'berkas',
        'sealing_mark',
        'report_sealing',
        'consignment_commodity',
        'identification',
        'exporting_comp',
        'address',
        'regist_number',
        'type_commodity',
        'type_packing',
        'qty_package',
        'weight',
        'volume',
        'type',
        'file_pengajuan',
        'status',
        'user_confirm',
        'admin_confirm',
        'no_surat',
        'noserial_surat',
        'commodity_surat',
        'sample_desc_surat',
        'code_number_surat',
        'received_surat',
        'testing_surat',
        'detail',
        'detail_laporan',
        'no_laporan',
        'berkas_laporan',
        'analisdate_surat',
        'no_sni',
        'grade',
        'done_survey',
        'berkas_analis',
        'bukti_pembayaran_pengujian',
        'note_sertif',
        'note_laporan'
    ];
}
