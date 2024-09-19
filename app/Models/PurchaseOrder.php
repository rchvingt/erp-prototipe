<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';
    protected $primaryKey = 'id_po';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_supplier',
        'nomor_order',
        'tgl_po',
        'status',
        'id_pegawai',
        'disetujui_oleh',
        'disetujui_tgl',
        'tgl_kirim',
    ];

    public function supplier()
    {
        return $this->belongsTo(RefSupplier::class, 'id_supplier', 'id_supplier');
    }

    public function poByUser()
    {
        return $this->belongsTo(User::class, 'id_pegawai', 'id');
    }

    public function verifByUser()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh', 'id');
    }
}
