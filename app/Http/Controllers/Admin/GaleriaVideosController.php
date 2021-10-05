<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Rules\RuleYouTube;
use Illuminate\Http\Request;

class GaleriaVideosController extends AdminController {
    //
    public function __construct() {
        $this->dados['menu'] = 'videos';
    }

     /** Lista as videos */
     public function index(Request $request) {

        $this->dados['buscar'] = $request->buscar;
        $video = Video::orderBy('id', 'desc');
        if ($request->buscar)
            $video = $video->where('titulo', 'like', '%'.$request->buscar.'%')
                                ->orWhere('descricao', 'like', '%'. $request->buscar.'%');
        $this->dados['videos'] = $video->simplePaginate(10)->withQueryString();
        
        return view('admin.videos.listar', $this->dados);
    }

    /** 
     * Abre a tela cadastrar nova video
     */
    public function novo() {
        $this->tinyMCE();
        $this->dados['video'] = new Video;
        return view('admin.videos.novo', $this->dados);
    }

    /** 
     * Tenta salvar uma nova video
     */
    public function cadastrar(Request $request) {
        $request->validate([
            'titulo'            => 'required',
            'data_publicacao'   => 'required',
            'video'             => ['required', new RuleYouTube],
            'capa'              => 'nullable|image|max:3100',
        ]);
        $dados = $request->except(['_token', 'capa']);
        $dados['video_id'] = Video::videoID($dados['video']);
        $video = Video::create($dados);

        if ($request->hasFile('capa')) {
            $extensao = $request->capa->extension();
            $video->capa = $nomeArquivo = 'video_'.$video->id.'.'.$extensao;
            $request->capa->storeAs('public/videos', $nomeArquivo);
            $video->save();
        }

        return redirect()->route('admin.videos.listar')->with(['sucesso' => 'Vídeo cadastrada com sucesso']);
    }

    /** 
     * Abre a tela de editar video
     * @param $id id da video
     */
    public function edicao(int $id) {
        $this->tinyMCE();
        $this->dados['video'] = Video::findOrFail($id);
        return view('admin.videos.edicao', $this->dados);
    }
    
    /** Tenta editar uma video e salvar no banco
     * @param $id id da video
     */
    public function editar(Request $request, int $id) {
        $request->validate([
            'titulo'            => 'required',
            'data_publicacao'   => 'required',
            'video'             => ['required', new RuleYouTube],
            'capa'              => 'nullable|image|max:3100',
        ]);

        $dados = $request->except(['_token', 'capa']);
        $dados['video_id'] = Video::videoID($dados['video']);
        $video = Video::findOrFail($id);
        $video->fill($dados);

        if ($request->hasFile('capa')) {
            $extensao = $request->capa->extension();
            $video->capa = $nomeArquivo = 'video_'.$video->id.'.'.$extensao;
            $request->capa->storeAs('public/videos', $nomeArquivo);
        }
        $video->save();

        return redirect()->route('admin.videos.listar')->with(['sucesso' => 'Vídeo editada com sucesso']);
    }
    
    /** Remove uma video
     * @param $id id da video
     */
    public function excluir(int $id) {
        Video::destroy($id);
        return redirect()->route('admin.videos.listar')->with('sucesso', 'Vídeo excluída');
    }

    /** Remove uma capa de um vídeo
     * @param $id id do vídeo
     */
    public function removerCapa(int $id) {
        $video = Video::findOrFail($id);
        $video->capa = null;
        $video->save();

        return redirect()->route('admin.videos.listar')->with(['sucesso' => 'Capa removida com sucesso']);
    }
}
