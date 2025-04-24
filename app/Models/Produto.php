<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['confeitaria_id', 'nome', 'valor', 'descricao', 'imagem'];

    public function confeitaria()
    {
        return $this->belongsTo(Confeitaria::class);
    }
}
