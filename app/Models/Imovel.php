<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "imoveis";

    public function imagens()
    {
        return $this->hasMany(Imagem::class);
    }

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'bairro_id');
    }

    public function finalidade()
    {
        return $this->belongsTo(Finalidade::class, 'finalidade_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }
}
