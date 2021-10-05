@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@csrf

<!-- TITULO -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Título *</label>
    <div class="col-sm-10">
        <input type="text" name="titulo" value="{{old('titulo', $video->titulo)}}" placeholder="Título (Obrigatório)" class="form-control">
    </div>
</div>

<!-- DATA PUBLICAÇÃO -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Data da Publicação *
        <br/>
        <small>Data que a publicação vai ao ar</small>

    </label>
    <div class="col-sm-10">
        <input type="date" name="data_publicacao" value="{{old('data_publicacao', $video->data_publicacao)}}" class="form-control">
    </div>
</div>

<!-- DESCRIÇÃO -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="tinymce" name="descricao" placeholder="Descrição opcional">{{old('descricao', $video->descricao)}}</textarea>
    </div>
</div>

<!-- VIDEO -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Link YouTube *</label>
    <div class="col-sm-10">
        <input type="text" name="video" value="{{old('video', $video->video)}}" placeholder="Inserir um link para vídeo do youtube (Obrigatório)" class="form-control">
    </div>
</div>


<!-- CAPA -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        Capa<br/>
        <small>Caso a capa não seja informada, irá ser usado a thumbnail do vídeo no youtube</small>
    </label>
    <div class="col-sm-10">
        <input type="file" name="capa" accept=".gif,.jpg,.jpeg,.png" />
    </div>
</div>
