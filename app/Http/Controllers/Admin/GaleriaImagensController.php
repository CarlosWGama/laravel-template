<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\Imagem;
use Illuminate\Http\Request;

class GaleriaImagensController extends AdminController {
    
    //
    public function __construct() {
        $this->dados['menu'] = 'imagens';
    }

     /** Lista as galerias */
     public function index(Request $request) {

        $this->dados['buscar'] = $request->buscar;
        $galeria = Galeria::orderBy('id', 'desc');
        if ($request->buscar)
            $galeria = $galeria->where('titulo', 'like', '%'.$request->buscar.'%')
                                ->orWhere('descricao', 'like', '%'. $request->buscar.'%');
        $this->dados['galerias'] = $galeria->simplePaginate(10)->withQueryString();
        
        return view('admin.imagens.listar', $this->dados);
    }

    /** 
     * Abre a tela cadastrar nova galeria
     */
    public function nova() {
        $this->tinyMCE();
        return view('admin.imagens.nova', $this->dados);
    }

    /** 
     * Tenta salvar uma nova galeria
     */
    public function cadastrar(Request $request) {
        $request->validate([
            'titulo'            => 'required',
            'data_publicacao'   => 'required'
        ]);
        $dados = $request->except(['_token']);
        $galeria = Galeria::create($dados);

        return redirect()->route('admin.imagens.edicao', [$galeria->id])->with(['sucesso' => 'Galeria cadastrada com sucesso']);
    }

    /** 
     * Abre a tela de editar galeria
     * @param $id id da galeria
     */
    public function edicao(int $id) {
        $this->tinyMCE();
        $this->dados['galeria'] = Galeria::with('imagens')->findOrFail($id);
        return view('admin.imagens.edicao', $this->dados);
    }
    
    /** Tenta editar uma galeria e salvar no banco
     * @param $id id da galeria
     */
    public function editar(Request $request, int $id) {
        $request->validate([
            'titulo'            => 'required',
            'data_publicacao'   => 'required',
        ]);

        $dados = $request->except(['_token']);
        Galeria::where('id', $id)->update($dados);

        return redirect()->route('admin.imagens.edicao', [$id])->with(['sucesso' => 'Galeria editada com sucesso']);
    }
    
    /** Remove uma imagem
     * @param $id id da imagem
     */
    public function excluir(int $id) {
        Galeria::destroy($id);
        return redirect()->route('admin.imagens.listar')->with('sucesso', 'Galeria excluída');
    }

    /** adiciona uma imagem na galeria
     * @param $id id do galeria
     */
    public function adicionarImagem(Request $request, int $galeriaID) {
        $galeria = Galeria::findOrFail($galeriaID);

        if ($request->hasFile('foto')) {
            $imagem = Imagem::create(['galeria_id' => $galeriaID]);
            //Salva imagem
            $extensao = $request->foto->extension();
            $imagem->foto = $nomeArquivo = 'imagem_'.$galeriaID.'_'.$imagem->id.'.'.$extensao;
            $request->foto->storeAs('public/imagens', $nomeArquivo);
            $imagem->save();

            //Caso a galeria não tenha imagens, essa será a capa da galeria
            if (empty($galeria->capa_id)) {
                $galeria->capa_id = $imagem->id;
                $galeria->save();
            }

            $galeria = Galeria::with('imagens')->findOrFail($galeriaID);
            

            return response()->json(['sucesso' => true, 'galeria' => $galeria], 200);
        }
        return response()->json(['sucesso' => false], 200);
        
    }

    /** Remova uma imagem na galeria
     * @param $galeriaID
     * @param $imagemID
     */
    public function removerImagem(int $galeriaID, int $imagemID) {
        $galeria = Galeria::findOrFail($galeriaID);
        //Atualiza a capa, caso imagem removida seja a capa
        if ($galeria->capa_id == $imagemID) {
            $novaCapa = Imagem::where('id', "!=", $imagemID)
                                ->where('galeria_id', $galeriaID)->first();
            if ($novaCapa)
                $galeria->capa_id = $novaCapa->id;
            else
                $galeria->capa_id = null; //Não tem mais foto 
            $galeria->save();
        }
        Imagem::destroy($imagemID);
        $galeria = Galeria::with('imagens')->find($galeriaID);
        return response()->json(['sucesso' => true, 'galeria' => $galeria], 200);
    }

    /**
     * adiciona uma imagem na galeria
     * @param $id id do galeria
     */
    public function selecionarCapa(Request $request, int $galeriaID, int $imagemID) {
        $imagem = Imagem::where('galeria_id', $galeriaID)->where('id', $imagemID)->firstOrFail();
        Galeria::where('id', $galeriaID)->update(['capa_id' => $imagem->id]);

        $galeria = Galeria::with('imagens')->find($galeriaID);
        return response()->json(['sucesso' => true, 'galeria' => $galeria], 200);
    }
}
