<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function pedidos(){
        return $this ->hasMany(Pedido::class)->withPivot(["cantidad"])-> withTimestamps();
    }

    public function cliente(){
        return $this ->hasMany(Cliente::class);
    }
}
