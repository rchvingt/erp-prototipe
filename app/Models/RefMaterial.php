<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMaterial extends Model
{
    use HasFactory;
    protected $table = 'ref_material';
    protected $primaryKey = 'id_material';
    public $incrementing = true;           // Jika 'id_material' auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'material', 'kode',
    ];
}
