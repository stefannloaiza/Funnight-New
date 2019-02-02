@extends('layouts.app') 
@section('content')
<!--<h1>configuracion de mi cuenta</h1>-->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    @include('includes.message')

            <div class="card">
                <div class="card-header">Configuración de mi cuenta</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data" aria-label="configuración de mi cuenta">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}"
                                    required autofocus> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{Auth::user()->surname }}"
                                    required autofocus> @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ Auth::user()->nick }}"
                                    required autofocus> @if ($errors->has('nick'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nick') }}</strong>
                                        </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}"
                                    readonly="readonly"> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                            </div>
                        </div>
                        <hr>

                        <div id="roleUser">
                            <h4 class="text-center usertext">
                                Registro de usuario
                            </h4>
                            <br>
                            <div class="form-group row">
                                <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('words.Pais Usuario') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="pais" id="paisUser" style="height: auto;">
                                            {{-- <option value="">Selecciona el pais</option> --}}
                                            @foreach ($paises as $pais)
                                                @if ($pais->id == Auth::user()->paisActual)
                                                    <option value="{{ $pais->id }}" selected>{{ $pais->nombre }}</option> 
                                                @else
                                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('pais'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pais') }}</strong>
                                            </span> @endif
                                </div>
                            </div>
=======
                        {{--
                        <div class="col-md-6">
                            <select class="form-control" name="pais" id="paisUser" style="height: auto;">
                                <option value="">Selecciona el pais</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                @endforeach
                            </select> @if ($errors->has('pais'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pais') }}</strong>
                                </span> @endif
                        </div> --}}
>>>>>>> daf1047b2e2f2dd5c42a1391c0591e3551447e98

                            <div class="form-group row">
                                <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad Usuario') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="ciudad" id="ciudadUser" style="height: auto;">
                                            @foreach ($ciudades as $ciudad)
                                                @if ($ciudad->id == Auth::user()->ciudadActual)
                                                    <option value="{{ $ciudad->id }}" selected>{{ $ciudad->nombre }}</option> 
                                                @else
                                                    <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option> 
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('ciudad'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ciudad') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zona" class="col-md-4 col-form-label text-md-right">{{ __('Zona') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="zona" id="zonaUser" style="height: auto;">
                                            @switch( Auth::user()->zona )
                                                @case("NOR")
                                                    <option value="NOR" selected>Norte</option>
                                                    <option value="SUR">Sur</option>
                                                    <option value="EST">Este</option>
                                                    <option value="OES">Oeste</option>
                                                    @break
                                                @case("SUR")
                                                    <option value="NOR">Norte</option>
                                                    <option value="SUR" selected>Sur</option>
                                                    <option value="EST">Este</option>
                                                    <option value="OES">Oeste</option>
                                                    @break
                                                @case("EST")
                                                    <option value="NOR">Norte</option>
                                                    <option value="SUR">Sur</option>
                                                    <option value="EST" selected>Este</option>
                                                    <option value="OES">Oeste</option>
                                                    @break
                                                @case("OES")
                                                    <option value="NOR">Norte</option>
                                                    <option value="SUR">Sur</option>
                                                    <option value="EST">Este</option>
                                                    <option value="OES" selected>Oeste</option>
                                                    @break
                                                @default
                                            @endswitch
                                        </select> @if ($errors->has('zona'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zona') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="genero" id="genUser" style="height: auto;">
                                                <option value="{{ $ciudad->id }}" selected>{{ $ciudad->nombre }}</option>
                                            @if ( Auth::user()->genero == "MAS" )
                                                <option value="MAS" selected>Masculino</option>
                                                <option value="FEM">Femenino</option> 
                                            @else
                                                <option value="MAS">Masculino</option>
                                                <option value="FEM" selected>Femenino</option>
                                            @endif
                                        </select> @if ($errors->has('genero'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('genero') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('words.Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion"
                                        value="{{ Auth::user()->direccion_residencia }}" autofocus>                                    @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fechaNac" class="col-md-4 col-form-label text-md-right">{{ __('words.FechaNacimiento') }}</label>

                                <div class="col-md-6">
                                    <input id="fechaNac" type="date" class="form-control{{ $errors->has('fechaNac') ? ' is-invalid' : '' }}" name="fechaNac"
                                        value="{{ Auth::user()->fechaNacimiento }}" autofocus>                                    @if ($errors->has('fechaNac'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fechaNac') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('words.Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono"
                                        value="{{ Auth::user()->telefono }}" autofocus> 
                                        @if($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('words.Celular') }}</label>

                                <div class="col-md-6">
                                    <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ Auth::user()->celular }}"
                                        autofocus> @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('celular') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <hr>

                            <h4 class="text-center">
                                Hablanos de ti. Cuales son tus gustos?
                            </h4>
                            <br>

                            <div class="form-group row">
                                <label for="establecimiento" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de establecimiento preferido') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="establecimiento" id="siteUser" style="height: auto;">
                                            @foreach ($tipoEstablecimiento as $type)
                                                @if ($type->id_tipo_establecimiento == Auth::user()->tipo_establecimiento)
                                                    <option value="{{ $type->id_tipo_establecimiento }}" selected>{{ $type->nombre }}</option>
                                                @else
                                                    <option value="{{ $type->id_tipo_establecimiento }}">{{ $type->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('establecimiento'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('establecimiento') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comida" class="col-md-4 col-form-label text-md-right">{{ __('Comida preferida') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="comidaUser" id="comidaUser" style="height: auto;">
                                            @foreach ($comidas as $comida)
                                                @if ($comida->id_comida == Auth::user()->tipo_comida)
                                                    <option value="{{ $comida->id_comida }}" selected>{{ $comida->nombre }}</option>
                                                @else
                                                    <option value="{{ $comida->id_comida }}">{{ $comida->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('comida'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comida') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ambiente" class="col-md-4 col-form-label text-md-right">{{ __('Ambiente preferido en un sitio nocturno') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="ambienteUser" id="ambienteUser" style="height: auto;">
                                            @foreach ($ambientes as $ambiente)
                                                @if ($ambiente->id_ambiente == Auth::user()->tipo_ambiente)
                                                    <option value="{{ $ambiente->id_ambiente }}" selected>{{ $ambiente->nombre }}</option>
                                                @else
                                                    <option value="{{ $ambiente->id_ambiente }}">{{ $ambiente->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('ambiente'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ambiente') }}</strong>
                                            </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="musica" class="col-md-4 col-form-label text-md-right">{{ __('Musica que te gusta escuchar') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="musicaUser" id="musicaUser" style="height: auto;">
                                            @foreach ($musica as $music)
                                                @if ($music->id_musica == Auth::user()->tipo_musica)
                                                    <option value="{{ $music->id_musica }}" selected>{{ $music->nombre }}</option>
                                                @else
                                                    <option value="{{ $music->id_musica }}">{{ $music->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select> @if ($errors->has('musica'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('musica') }}</strong>
                                            </span> @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                            <div class="col-md-6">
    @include('includes.avatar')
                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path">                                @if ($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image_path') }}</strong>
                                            </span> @endif
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection