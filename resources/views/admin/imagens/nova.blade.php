@extends('admin.template')

@section('titulo', 'Nova Galeria de Imagens')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <h5>Cadastro de Galeria de Imagens</h5>
    </div>

    <form action="{{route('admin.imagens.cadastrar')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body card-block">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TITULO -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Título *</label>
                <div class="col-sm-10">
                    <input type="text" name="titulo" value="{{old('titulo')}}" placeholder="Título (Obrigatório)" class="form-control">
                </div>
            </div>

            <!-- DATA PUBLICAÇÃO -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Data da Publicação *
                    <br/>
                    <small>Data que a publicação vai ao ar</small>

                </label>
                <div class="col-sm-10">
                    <input type="date" name="data_publicacao" value="{{old('data_publicacao')}}" class="form-control">
                </div>
            </div>

            <!-- DESCRIÇÃO -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="tinymce" name="descricao" placeholder="Descrição opcional">{{old('descricao')}}</textarea>
                </div>
            </div>

            <small>Complete o cadastro básico para inserir as imagens</small>

        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection