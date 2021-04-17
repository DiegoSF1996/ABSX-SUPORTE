<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usu_status',
        'usu_nome',
        'usu_email',
        'usu_telefone',
        'usu_tipousuario'
    ];
    protected $table = 'usuario';
    protected $primaryKey = 'usu_codigo';

}
