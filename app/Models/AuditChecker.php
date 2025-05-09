<?php

namespace App\Models;

use App\Models\User;
use App\Models\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditChecker extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_audit',
        'produk',
        'dus',
        'btl',
        'kotak',
        'total'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit');
    }
}

