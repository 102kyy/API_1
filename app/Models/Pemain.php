<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pemain', 'posisi', 'foto', 'tgl_lahir', 'harga_pasar', 'id_klub'];

    public function liga()
    {
        return $this->belongsTo(Liga::class, 'id_liga');
    }

    public function pemain()
    {
        return $this->hasMany(Pemain::class, 'id_klub');
    }

     public function fan()
    {
        return $this->belongsToMany(Fan::class, 'fan_klub', 'id_klub', 'id_fan');
    }

 
}
