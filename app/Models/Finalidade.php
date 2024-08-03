<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finalidade extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imovel()
    {
        return $this->hasMany(Imovel::class, 'finalidade_id');
    }
}
