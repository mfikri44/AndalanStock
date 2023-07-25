<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
