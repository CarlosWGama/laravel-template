@extends('admin.template')

@section('titulo', 'Edição de Galeria de imagens')

@push('css')
    <style>
        .card-header {
            cursor: pointer;
        }

        /* FOTOS */
        #fotos {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .foto-card {
            margin: 10px;
            width: 200px;
        }

        .card-conteudo {
            display: flex;
            padding:5px;
            justify-content: space-around;
            align-items: center;
            flex-direction: row;
        }

        .foto-capa {
            margin-top:10px;
        }
    </style>
@endpush

@section('conteudo')

@if (session('sucesso'))
<p class="alert alert-success">
   {{session('sucesso')}}
</p>
@endif

{{-- INFORMAÇÔES GERAIS --}}
<div class="card">
    <div class="card-header" onclick="ocultarCampo('#galeria-informacoes')">
        <h5>Informações Gerais da Galeria</h5>
        <small>Clicar para abrir ou fechar</small>
    </div>

    <form id="galeria-informacoes" style="display:none;" action="{{route('admin.imagens.editar', [$galeria->id])}}" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="titulo" value="{{old('titulo', $galeria->titulo)}}" placeholder="Título (Obrigatório)" class="form-control">
                </div>
            </div>

            <!-- DATA PUBLICAÇÃO -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Data da Publicação *
                    <br/>
                    <small>Data que a publicação vai ao ar</small>

                </label>
                <div class="col-sm-10">
                    <input type="date" name="data_publicacao" value="{{old('data_publicacao', $galeria->data_publicacao)}}" class="form-control">
                </div>
            </div>

            <!-- DESCRIÇÃO -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="tinymce" name="descricao" placeholder="Descrição opcional">{{old('descricao', $galeria->descricao)}}</textarea>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Editar informações gerais
            </button>
        </div>
    
    </form>
</div>

{{-- FOTOSO --}}
<div class="card">
    <div class="card-header" onclick="ocultarCampo('#galeria-fotos')">
        <h5>Fotos da Galeria</h5>
    </div>

    <div id="galeria-fotos">

        <div class="card-body card-block">

            <!-- FOTO -->
            <form id="form-upload-foto" method="post" enctype="multipart/form-data" class="form-group row">
                <label class="col-sm-2 col-form-label">Nova foto</label>
                <div class="col-sm-10">
                    <input id="file-foto" type="file" name="foto" class="form-control">
                    <p id="msg-enviando" style="display:none;">
                        <img src="{{asset('admin/images/loading3.gif')}}" width="30"/>Enviando, aguarde...
                    </p>
                </div>
            </form>
            <p class="alert alert-success" id="msg-enviado"  style="display:none;">Enviada</p>

        </div>
        
        <div class="card-footer">
            <h6>Fotos</h6>

            {{-- FOTOS CADASTRADAS --}}
            <div id="fotos">
            
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
    <script>

        $(document).ready(() => {
            atualizarGaleria({!!json_encode($galeria->imagens)!!}, {{$galeria->capa_id}})
        })

        // OCULTA UM CARD
        function ocultarCampo(id) {
            $(id).toggle('slow');
        }

        //REMOVE UMA FOTO
        function removerFoto(id) {
            //Envia
            $.ajax({
                type:'GET',
                url: `{{route('admin.imagens.remover-imagem', [$galeria->id])}}/${id}`,
                success:function(resposta){
                    console.log("Feito");
                    console.log(resposta);
                    const {galeria} = resposta;
                    atualizarGaleria(galeria.imagens, galeria.capa_id);
                },
                error: function(erro) {
                    console.log(erro);
                }
            });
        }

        //ATUALIZA QUEM É A CAPA DA GALERIA
        function tornarCapa(id) {
            //Envia
            $.ajax({
                type:'GET',
                url: `{{route('admin.imagens.selecionar-capa', [$galeria->id])}}/${id}`,
                success:function(resposta){
                    console.log("Feito");
                    console.log(resposta);
                    const {galeria} = resposta;
                    atualizarGaleria(galeria.imagens, galeria.capa_id);
                },
                error: function(erro) {
                    console.log(erro);
                }
            });
        }

        //CRIA O CAMPO DE FOTO
        function atualizarGaleria(fotos, capaID) {
            $('#fotos').html('');

            if (fotos != null || fotos != undefined) {
                fotos.forEach(foto => {
                    console.log(foto.id == capaID);
                    $('#fotos').append(`<div class="foto-card card">
                            <img class="card-img-top" src="${foto.url}" />
                            <div class="card-conteudo">
                                <button onclick="removerFoto(${foto.id})" class="btn btn-sm btn-danger">Remover</button>
                                ${ foto.id == capaID? '<p class="foto-capa">Capa Atual</p>': `<button class="btn btn-sm btn-info" onclick="tornarCapa(${foto.id})">Tornar Capa</button>`}
                            </div>
                        </div>`);
                })
            }
        }

        //ADICIONA UMA FOTO
        $('#file-foto').change(() => {
            //Inicia o Envio  
            $('#file-foto').hide();
            $('#msg-enviando').show();
            $('#msg-enviado').hide();

            //Busca o arquivo
            var file_data = $('#file-foto').prop('files')[0];
            var form_data = new FormData();
            form_data.append('foto', file_data);
            //Envia
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val(),
                },
                type:'POST',
                url: '{{route('admin.imagens.adicionar-imagem', [$galeria->id])}}',
                data: form_data,
                contentType : false,
                processData : false,
                cache:false,
                success:function(resposta){
                    console.log("Feito");
                    console.log(resposta);
                    const {galeria} = resposta;
                    $('#file-foto').val('');
                    $('#file-foto').show();
                    $('#msg-enviando').hide();
                    $('#msg-enviado').show();
                    atualizarGaleria(galeria.imagens, galeria.capa_id);
                },
                error: function(erro) {
                    console.log(erro);
                }
            });
        })


    </script>
@endpush