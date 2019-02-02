@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('words.Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('words.Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('words.Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required autofocus> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('words.Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}"
                                    required autofocus> @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        {{-- antes estaba words.Nick' --}}
                        <div class="form-group row">
                            <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ old('nick') }}"
                                    required autofocus> @if ($errors->has('nick'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('words.E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('words.Role') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" id="role" style="height: auto;" required>
                                    <option value="">Selecciona el rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->description }}</option> 
                                    @endforeach
                                </select> @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('words.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('words.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <hr>

                        <div id="roleUser" style="display: none;">
                            <h4 class="text-center usertext">
                                Registro de usuario
                            </h4>
                            <br>
                            <div class="form-group row">
                                <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('words.Pais Usuario') }}</label>

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
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad Usuario') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="ciudad" id="ciudadUser" style="height: auto;" disabled>
                                        {{-- <option value="">Selecciona la ciudad</option> --}}
                                        {{-- @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                        @endforeach --}}
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
                                        <option value="">Selecciona la zona</option>
                                        <option value="NOR">Norte</option>
                                        <option value="SUR">Sur</option>
                                        <option value="EST">Este</option>
                                        <option value="OES">Oeste</option>
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
                                        <option value="">Selecciona el genero</option>
                                        <option value="MAS">Masculino</option>
                                        <option value="FEM">Femenino</option>
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
                                        value="{{ old('direccion') }}" autofocus> @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fechaNac" class="col-md-4 col-form-label text-md-right">{{ __('words.FechaNacimiento') }}</label>

                                <div class="col-md-6">
                                    <input id="fechaNac" type="date" class="form-control{{ $errors->has('fechaNac') ? ' is-invalid' : '' }}" name="fechaNac"
                                        value="{{ old('fechaNac') }}" autofocus> @if ($errors->has('fechaNac'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fechaNac') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('words.Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono"
                                        value="{{ old('telefono') }}" autofocus> @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('words.Celular') }}</label>

                                <div class="col-md-6">
                                    <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}"
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
                                        <option value="">Selecciona el tipo de establecimiento</option>
                                        @foreach ($tipoEstablecimiento as $type)
                                            <option value="{{ $type->id_tipo_establecimiento }}">{{ $type->nombre }}</option> 
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
                                        <option value="">Selecciona tu comida</option>
                                        @foreach ($comidas as $comida)
                                            <option value="{{ $comida->id_comida }}">{{ $comida->nombre }}</option> 
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
                                        <option value="">Selecciona el ambiente</option>
                                        @foreach ($ambientes as $ambiente)
                                            <option value="{{ $ambiente->id_ambiente }}">{{ $ambiente->nombre }}</option> 
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
                                        <option value="">Selecciona tu musica</option>
                                        @foreach ($musica as $music)
                                            <option value="{{ $music->id_musica }}">{{ $music->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('musica'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('musica') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <hr>
                        </div>

                        <div id="roleSite" style="display: none;">
                            <h4 class="text-center">
                                Registro del establecimiento
                            </h4>
                            <br>
                            <div class="form-group row">
                                <label for="paisSite" class="col-md-4 col-form-label text-md-right">{{ __('words.Pais Establecimiento') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="paisSite" id="paisSite" style="height: auto;">
                                        <option value="">Selecciona el pais</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('paisSite'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paisSite') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ciudadSite" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad Establecimiento') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="ciudadSite" id="ciudadSite" style="height: auto;" disabled>
                                        {{-- <option value="">Selecciona la ciudad</option> --}}
                                        {{-- @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                        @endforeach --}}
                                    </select> @if ($errors->has('ciudadSite'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ciudadSite') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zona" class="col-md-4 col-form-label text-md-right">{{ __('Zona') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="zonaSite" id="zonaSite" style="height: auto;">
                                        <option value="">Selecciona la zona</option>
                                        <option value="NOR">Norte</option>
                                        <option value="SUR">Sur</option>N</option>
                                        <option value="EST">Este</option>
                                        <option value="OES">Oeste</option>
                                    </select> @if ($errors->has('zona'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('zona') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('words.Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="direccionSite" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccionSite"
                                        value="{{ old('direccion') }}" autofocus> @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('words.Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefonoSite" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefonoSite"
                                        value="{{ old('telefono') }}" autofocus> @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Celular Administrativo') }}</label>

                                <div class="col-md-6">
                                    <input id="celularSite" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celularSite"
                                        value="{{ old('celular') }}" autofocus> @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('celular') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <hr>

                            <h4 class="text-center">
                                Hablanos del establecimiento. Cuales son tus gustos?
                            </h4>
                            <br>

                            <div class="form-group row">
                                <label for="establecimiento" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Establecimiento') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="typeSite" id="typeSite" style="height: auto;">
                                        <option value="">Selecciona el tipo de establecimiento</option>
                                        @foreach ($tipoEstablecimiento as $type)
                                            <option value="{{ $type->id_tipo_establecimiento }}">{{ $type->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('establecimiento'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('establecimiento') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comida" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Comida u producto (si lo manejan)') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="comidaSite" id="comidaSite" style="height: auto;">
                                        <option value="">Selecciona tu comida</option>
                                        @foreach ($comidas as $comida)
                                            <option value="{{ $comida->id_comida }}">{{ $comida->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('comida'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comida') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ambiente" class="col-md-4 col-form-label text-md-right">{{ __('Ambiente que lo caracteriza') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="ambienteSite" id="ambienteSite" style="height: auto;">
                                        <option value="">Selecciona el ambiente</option>
                                        @foreach ($ambientes as $ambiente)
                                            <option value="{{ $ambiente->id_ambiente }}">{{ $ambiente->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('ambiente'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ambiente') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="musica" class="col-md-4 col-form-label text-md-right">{{ __('Musica que se escucha') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="musicaSite" id="musicaSite" style="height: auto;">
                                        <option value="">Selecciona tu musica</option>
                                        @foreach ($musica as $music)
                                            <option value="{{ $music->id_musica }}">{{ $music->nombre }}</option> 
                                        @endforeach
                                    </select> @if ($errors->has('musica'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('musica') }}</strong>
                                        </span> @endif
                                </div>
                            </div>

                            <hr>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('words.Registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/register.js') }}"></script>
@endsection