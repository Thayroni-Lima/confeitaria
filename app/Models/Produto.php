<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['confeitaria_id', 'nome', 'valor', 'descricao', 'imagem'];

    protected $casts = [
        'imagem' => 'array',
    ];
    

    public function confeitaria()
    {
        return $this->belongsTo(Confeitaria::class);
    }
}
