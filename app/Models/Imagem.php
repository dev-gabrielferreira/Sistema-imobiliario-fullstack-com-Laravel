<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];
    
    protected $table = "imagens";

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }
}
