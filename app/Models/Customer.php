<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model{
    use HasFactory;
    protected $table='customer';
    public $timestamps=false;
    protected $fillable=[
        'nama_customer',
        'alamat',
        'no_hp'
    ];
}
?>