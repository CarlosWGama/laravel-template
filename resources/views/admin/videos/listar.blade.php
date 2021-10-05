@extends('admin.template')

@section('titulo', 'Listar videos')


@push('css')
    <style>
        .form-busca {
            padding: 20px;
            flex-direction: row;
            display: flex;  
            height: 75px;
        }
        .input-group {
            max-width: 400px;
        }
    </style>
@endpush

@section('conteudo')

<div class="card">
    <div class="card-header">
        <h5>Vídeos Cadastrados</h5>
    </div>


    <form action="{{route('admin.videos.listar')}}">
        <div class="form-busca">
            <!-- BUSCAR -->
            <div class="input-group">
                <input type="text" name="buscar" value="{{$buscar}}" placeholder="Digite um valor para buscar" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
    
    <div style="width:200px; margin-left:20px">
    <a href="{{route('admin.videos.novo')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Cadastrar vídeo
    </a>
    </div>

    <div class="card-block table-border-style">
        <div class="table-responsive">
                @if(session('sucesso'))
                <div class="alert alert-success" role="alert" style="margin:0px 10px">
                    {{session('sucesso')}}
                </div>
                @endif
            <table class="table">
                <thead>
                    <tr>
                        <td style="width:10%">ID</td>
                        <td style="width:50%">Título</td>
                        <td>Capa</td>
                        <td>Data da Publicação</td>
                        <td style="width:10%">Opções</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <!-- ID -->
                        <td><h6>{{$video->id}}</h6></td>
                        <!-- TITULO -->
                        <td><h6>{{$video->titulo}}</h6></td>
                        <!-- CAPA -->
                        <td><img src="{{$video->thumbnail}}" width="100" /></td>
                        <!-- DATA DA PUBLICAÇÃO -->
                        <td><h6>{{date('d/m/Y', strtotime($video->data_publicacao))}}</h6></td>
                        <!-- OPÇÕES -->   
                        <td>
                            <a href="{{route('admin.videos.edicao', ['id' => $video->id])}}" title="Editar" class="btn btn-sm btn-success">
                               <i class="fa fa-edit"></i>
                            </a>
                            <span class="btn btn-sm btn-danger remover-modal" title="Excluir" data-toggle="modal" data-target="#smallmodal" data-id="{{$video->id}}"><i class="fa fa-trash"></i></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Paginação -->
            <div style="padding:10px">{{$videos->links()}}</div>
    
        </div>
    </div>
    
</div>


    @push('javascript')
  <!-- modal small -->
  <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Remover conteúdo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                       Deseja Realmente excluir esse conteúdo?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-deletar">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->

    <script>
        let conteudoID;
        $('.remover-modal').click(function() {
            conteudoID = $(this).data('id');
        })

        $('.btn-deletar').click(() => window.location.href="{{route('admin.videos.excluir')}}/"+conteudoID);
    </script>
@endpush
@endsection