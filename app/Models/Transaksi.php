<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Transaksi extends Model{
    use HasFactory;
    protected $table='transaksi';
    public $timestamps=false;
    protected $fillable=[
        'id_produk',
        'id_customer',
        'qty',
        'transaksi_date',
        'is_void',
        'harga',
        'keterangan'
    ];
}
?>