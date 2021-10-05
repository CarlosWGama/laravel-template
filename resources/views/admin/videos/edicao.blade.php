@extends('admin.template')

@section('titulo', 'Edição de Vídeo')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <h5>Edição de Vídeo</h5>
    </div>

    <form action="{{route('admin.videos.editar', ['id' => $video->id])}}" method="post" class="form-material"  enctype="multipart/form-data" >
        
        <div class="card-body card-block">
            <!-- FORMULARIO -->
            @include('admin.videos._shared.form')
            <!-- FORMULARIO -->

            <!-- THUMBNAIL -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    Thumbnail<br/>
                    @if($video->capa)
                    <button type="button" data-toggle="modal" data-target="#smallmodal"  class="btn btn-danger btn-sm">
                        <i class="fa fa-save"></i> Remover Capa
                    </button>
                    @endif
                </label>
                <div class="col-sm-10">
                    <img src="{{$video->thumbnail}}" style="max-width:100%" />
                </div>
            </div>

        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Editar
            </button>
        </div>
    </form>
</div>
@endsection


@push('javascript')
<!-- modal small -->
<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="smallmodalLabel">Remover Capa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>
                     Deseja Realmente excluir essa Capa?
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
      $('.btn-deletar').click(() => window.location.href="{{route('admin.videos.remover-capa', ['id' => $video->id])}}");
  </script>
@endpush