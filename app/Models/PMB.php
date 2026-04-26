<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMB extends Model
{
    use HasFactory;

    protected $table = 'pmb'; // WAJIB didefinisikan

    protected $fillable = [
        'alur',
        'persyaratan_umum',
        'berkas',
        'jadwal',
        'faq',
        'link_pendaftaran'
    ];
}