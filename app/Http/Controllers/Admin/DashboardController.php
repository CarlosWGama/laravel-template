<?php

namespace App\Http\Controllers\Admin;

use App\Models\Galeria;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Video;

/**
 * Tela Inicial do Admin
 */
class DashboardController extends AdminController {

    public function __construct() {
        $this->dados['menu'] = 'dashboard';
    }

    /** Tela Inicial do Dashboard */
    public function index() {
        $this->dados['usuarios'] = Usuario::count();
        $this->dados['noticias'] = 0;
        $this->dados['imagens'] = Galeria::count();
        $this->dados['videos'] = Video::count();
        return view('admin.dashboard.index', $this->dados);
    }
}
