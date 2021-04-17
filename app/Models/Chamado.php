<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'usu_codigo_cliente',
        'usu_codigo_suporte',
        'cha_assunto',
        'cha_descricao',
        'cha_datacriacao',
        'cha_situacao',
    ];
    protected $table = 'chamado';
    protected $primaryKey = 'cha_codigo';
}
