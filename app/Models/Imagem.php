<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagem extends Model {
    use HasFactory;
    use SoftDeletes;
    
    protected $appends = ['url'];
    protected $table = 'galerias_imagens';

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

     /**
     * Caso existe capa, retorna a url completa da thumbnail
     *  */  
    public function getUrlAttribute() {
        return asset('storage/imagens/'.$this->foto);
    }
}
