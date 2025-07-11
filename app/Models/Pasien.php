<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RegisterPasien;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pasiens';

    protected $fillable = [
        'no_pasien',
        'name',
        'no_ktp',
        'address',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email',
    ];

    public function datatables($req){
        return $this->orderBy('created_at', 'DESC')->get();
    }

    public function register_products()
    {
        return $this->hasMany(RegisterPasien::class, 'pasien_id', 'id');
    }
}
