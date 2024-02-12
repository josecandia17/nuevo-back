<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podructo extends Model
{
    use HasFactory;

    public function categoria(){
        return $this ->hasMany(Categoria::class);
    }

    public function pedidos(){
        return $this ->hasMany(Pedido::class)->withPivot(["cantidad"])-> withTimestamps();
    }
}
