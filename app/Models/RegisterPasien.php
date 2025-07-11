<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pasien;

class RegisterPasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'register_pasiens';

    protected $fillable = [
        'pasien_id',
        'no_register',
        'poli_id',
        'pay',
    ];

    public function datatables($req){
        return $this->orderBy('created_at', 'DESC')->withTrashed()->get();
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }
}
