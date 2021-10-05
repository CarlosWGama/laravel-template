@extends('admin.template')

@section('titulo', 'Novo vídeo')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <h5>Cadastro de vídeo</h5>
    </div>

    <form action="{{route('admin.videos.cadastrar')}}" method="post" enctype="multipart/form-data">
        
        <div class="card-body card-block">
            <!-- FORMULARIO -->
            @include('admin.videos._shared.form')
            <!-- FORMULARIO -->
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection