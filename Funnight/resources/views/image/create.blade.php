@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center">
                    <h3><b>Subir nueva Publicación</b></h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="tipoPub" class="col-md-3 col-form-label text-md-right">{{ __('Tipo publicación') }}</label>

                            <div class="col-md-7">
                                <select class="form-control" name="tipoPub" id="tipoPub" style="height: auto;" required>
                                    <option value="">Selecciona el tipo</option>
                                    <option value="1">Promoción</option>
                                    <option value="2">Evento</option>
                                </select> @if ($errors->has('tipoPub'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tipoPub') }}</strong>
                                </span> @endif
                            </div>
                        </div>

                        <hr>
                        <div id="promotion" style="display: none;">
                            {{--
                            <div id="roleUser" style="display: none;"> --}}
                                <h4 class="text-center usertext">
                                    <b>Promoción</b>
                                </h4>
                                <br>

                                <div class="form-group row">
                                    <label for="image_path" class="col-md-3 col-form-label text-md-right">Subir Imagen o video aquí:</label>
                                    <div class="col-md-7">
                                        <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path')?'is-invalid':'' }}"
                                            /> {{ csrf_field() }} @if($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path') }}</strong>
                                        </span> @endif

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="iniDate" class="col-md-3 col-form-label text-md-right">Fecha inicial</label>
                                    <div class="col-md-7">
                                        <input id="iniDate" type="date" name="iniDate" class="form-control {{ $errors->has('iniDate')?'is-invalid':'' }}" min="{{ date('Y-m-d') }}" />                                        {{ csrf_field() }} @if($errors->has('iniDate'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('iniDate') }}</strong>
                                            </span> @endif

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="finDate" class="col-md-3 col-form-label text-md-right">Fecha final</label>
                                    <div class="col-md-7">
                                        <input id="finDate" type="date" name="finDate" class="form-control {{ $errors->has('finDate')?'is-invalid':'' }}" min="{{ date('Y-m-d') }}"/>                                        {{ csrf_field() }} @if($errors->has('finDate'))
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('finDate') }}</strong>
                                                </span> @endif

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                                    <div class="col-md-7">
                                        <textarea id="description" name="description" class="form-control {{ $errors->has('description')?'is-invalid':'' }}" ></textarea>                                        @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span> @endif
                                    </div>
                                </div>

                                <br>
                                <hr>
                            </div>


                            <div id="event" style="display: none;">
                                {{--
                                <div id="roleUser" style="display: none;"> --}}
                                    <h4 class="text-center usertext">
                                        <b>Evento</b>
                                    </h4>
                                    <br>

                                    <div class="form-group row">
                                        <label for="image_path2" class="col-md-3 col-form-label text-md-right">Subir Imagen o video aqui:</label>
                                        <div class="col-md-7">
                                            <input id="image_path2" type="file" name="image_path2" class="form-control {{ $errors->has('image_path2')?'is-invalid':'' }}"
                                                /> {{ csrf_field() }} @if($errors->has('image_path2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path2') }}</strong>
                                        </span> @endif

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="eventDate" class="col-md-3 col-form-label text-md-right">Fecha del evento</label>
                                        <div class="col-md-7">
                                            <input id="eventDate" type="date" name="eventDate" class="form-control {{ $errors->has('eventDate')?'is-invalid':'' }}" min="{{ date('Y-m-d') }}"/>                                            {{ csrf_field() }} @if($errors->has('eventDate'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('eventDate') }}</strong>
                                                </span> @endif

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description2" class="col-md-3 col-form-label text-md-right">Descripción</label>
                                        <div class="col-md-7">
                                            <textarea id="description2" name="description2" class="form-control {{ $errors->has('description2')?'is-invalid':'' }}" ></textarea>                                            @if($errors->has('description2'))
                                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('description2') }}</strong>
                              </span> @endif

                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3 text-center">
                                        <input type="submit" class="btn btn-primary" value="Subir Publicacion">
                                    </div>
                                </div>

                    </form>
                    </div>
                    </div>
                </div>
            </div>

            <script src="{{ asset('js/publication.js') }}"></script>
@endsection