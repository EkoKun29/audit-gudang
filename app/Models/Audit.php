<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'barang',
        'dus',
        'btl',
        'total',
        'total_real'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
