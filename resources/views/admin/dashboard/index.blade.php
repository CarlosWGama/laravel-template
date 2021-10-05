@extends('admin.template')


@section('titulo', 'Dashboard')
@section('subtitulo', 'Conteúdos Cadastrados')

@section('conteudo')

                <div class="row">

                    {{-- DASHBOARD --}}
                    <div class="col-xl-4 col-md-12">
                        <h6>Prefeitura</h6>
                        <div class="card mat-stat-card">
                            <div class="card-block">
                                <div class="row align-items-center b-b-default">
                                    {{-- USUARIOS --}}
                                    <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-user text-c-purple f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{$usuarios}}</h5>
                                                <p class="text-muted m-b-0">Usuários</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- NOTICIAS --}}
                                    <div class="col-sm-6 p-b-20 p-t-20 r-default">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-file-alt text-c-red f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{$noticias}}</h5>
                                                <p class="text-muted m-b-0">Noticias</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    {{-- FALE CONOSCO --}}
                                    <div class="col-sm-12 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-comments text-c-yellow f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{'0'}}</h5>
                                                <p class="text-muted m-b-0">Bla bla</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Turismo --}}
                    <div class="col-xl-4 col-md-12">
                        <h6>Turismo</h6>

                        <div class="card mat-stat-card">
                            <div class="card-block">
                                <div class="row align-items-center b-b-default">
                                    {{-- BLABLA --}}
                                    <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-sun text-c-yellow f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>0</h5>
                                                <p class="text-muted m-b-0">BLABLA</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- BLABLA --}}
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-calendar text-c-green f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{'0'}}</h5>
                                                <p class="text-muted m-b-0">BLABLA</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    {{-- IMAGENS --}}
                                    <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-image text-c-red f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{$imagens}}</h5>
                                                <p class="text-muted m-b-0">Imagens</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- VIDEOS --}}
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-film text-c-blue f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>{{$videos}}</h5>
                                                <p class="text-muted m-b-0">Vídeos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        
                    </div>

@endsection