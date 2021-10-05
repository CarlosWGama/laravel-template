<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Retorna o ID do vídeo no YouTube
     */
    public static function videoID($url): string {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return $my_array_of_vars['v']; 
    }

    public function getThumbnailAttribute() {
        if ($this->capa) return asset('storage/videos/'.$this->capa);
        else return "http://i3.ytimg.com/vi/{$this->video_id}/maxresdefault.jpg";
    }
}
