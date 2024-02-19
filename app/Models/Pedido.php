<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function podructos(){
        return $this ->belongsTo(podructo::class)->withPivot(["cantidad"])-> withTimestamps();
    }

    public function cliente(){
        return $this ->belongsTo(Cliente::class);
    }
}
