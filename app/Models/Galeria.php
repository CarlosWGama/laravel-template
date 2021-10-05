<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];


    /**
     * Retorna a imagem selecionada como capa
     */
    public function getCapaAttribute() {
        $capa = Imagem::find($this->capa_id);
        return $capa;
    }

    /**
     * Retorna as imagens da galeria
     */
    public function imagens() {
        return $this->hasMany('App\Models\Imagem', 'galeria_id');
    }
}
