<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSupplier extends Model
{
    use HasFactory;
    protected $table = 'ref_supplier';
    protected $primaryKey = 'id_supplier';
    public $incrementing = true;           // Jika 'id_supplier' auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'nama_supplier', 'alamat', 'telepon',
    ];
}
