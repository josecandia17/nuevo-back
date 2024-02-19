<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podructo extends Model
{
    use HasFactory;

    public function categoria(){
        return $this ->belongsTo(Categoria::class);
    }

    public function pedidos(){
        return $this ->belongsTo(Pedido::class)->withPivot(["cantidad"])-> withTimestamps();
    }
}
