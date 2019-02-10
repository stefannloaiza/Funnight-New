<?php

namespace App\Http\Controllers\Auth;

use App\Pais;
use App\Role;
use App\User;
use DateTime;
use App\Ciudad;
use App\Comida;
use App\Musica;
use App\Ambiente;
use App\Establecimiento;
use App\Precio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);

        if ($data['role'] == 2) {
            # Save user datas
            
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'nick' => $data['nick'],
                'email' => $data['email'],
                'role'=> $data['role'],
                'image'=> '',
                'userActive'=> 1,
                'password' => Hash::make($data['password']),
                
                // More data
                'paisActual' => $data['pais'],
                'ciudadActual' => $data['ciudad'],
                'genero'=> $data['genero'],
                'zona' => $data['zona'],
                'direccion_residencia' => $data['direccion'],
                'fechaNacimiento'=> new DateTime($data['fechaNac']) ,
                'telefono' => $data['telefono'],
                'celular' => $data['celular'],
                'tipo_establecimiento' => $data['establecimiento'],
                'tipo_comida'=> $data['comidaUser'],
                'tipo_ambiente'=> $data['ambienteUser'],
                'tipo_musica'=> $data['musicaUser'],

                'lastInteraction'=> new DateTime(),
            ]);
            
            $user->roles()->attach($data['role']);
            
            return $user;
        } else {
            # Save night site datas
            
            $site = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'nick' => $data['nick'],
                'email' => $data['email'],
                'role'=> $data['role'],
                'image'=> '',
                'userActive'=> 1,
                'password' => Hash::make($data['password']),

                 // More data
                'nit' => $data['nit'],
                'paisActual' => $data['paisSite'],
                'ciudadActual' => $data['ciudadSite'],
                'zona' => $data['zonaSite'],
                'direccion_residencia' => $data['direccionSite'],
                'telefono' => $data['telefonoSite'],
                'celular' => $data['celularSite'],
                'tipo_establecimiento' => $data['typeSite'],
                'tipo_comida'=> $data['comidaSite'],
                'tipo_ambiente'=> $data['ambienteSite'],
                'tipo_musica'=> $data['musicaSite'],
                'precio'=> $data['precioSite'],
                 
                'genero'=> '',
                'lastInteraction'=> new DateTime(),
                // 'fechaNacimiento'=> '',
            ]);
           
            
            $site->roles()->attach($data['role']);
            
            return $site;
        }
    }
}
