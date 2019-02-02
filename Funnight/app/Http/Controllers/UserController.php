<?php

namespace App\Http\Controllers;

use App\Pais;
use App\Role;
use App\User;
use App\Ciudad;
use App\Comida;
use App\Follow;
use App\Musica;
use App\Ambiente;
use App\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search= null)
    {
        if (!empty($search)) {
            // dd($search);
            $users =User::where('role', '2')
            ->where(function ($query) use ($search) {
                $query->where('nick', 'LIKE', '%'.$search.'%')
                 ->orWhere('name', 'LIKE', '%'.$search.'%')
                 ->orWhere('surname', 'LIKE', '%'.$search.'%')
                 ->orWhere('email', 'LIKE', '%'.$search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(50);
        } else {
            $users = User::where('role', '2')->orderBy('id', 'desc')->paginate(50);
        }
        return view('user.index', [
           'users' => $users
        ]);
    }

    /**
     * Metodo de configuracion de los datos del usuario autenticado.
     *
     * @return view
     */
    public function config()
    {
        $roles = Role::where('id', '!=', '1')->get();
        $paises = Pais::all();
        $ciudades = Ciudad::where('paisId', '=', \Auth::user()->paisActual)->get();

        $comidas = Comida::all();
        $musica = Musica::all();
        $ambientes = Ambiente::all();
        $typeEstablecimiento = Establecimiento::all();
        
        return view('user.config', [
            'roles' => $roles,
            'paises' => $paises,
            'ciudades' => $ciudades,
            'comidas' => $comidas,
            'musica' => $musica,
            'ambientes' => $ambientes,
            'tipoEstablecimiento' => $typeEstablecimiento,
        ]);
    }


    public function update(Request $request)
    {
        //conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //validacion del formulario
        $validate=$this->validate($request, [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'nick' => 'required|string|max:255|unique:users,nick,'.$id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        // dd($request);
       
        //recoger datos del formulario
        $name =$request->input('name');
        $surname =$request->input('surname');
        $nick =$request->input('nick');
        $email =$request->input('email');

        $pais = $request->input('pais');
        $ciudad = $request->input('ciudad');
        $zona = $request->input('zona');
        $genero = $request->input('genero');
        $direccion = $request->input('direccion');
        $fechaNac = $request->input('fechaNac');
        $telefono = $request->input('telefono');
        $celular = $request->input('celular');
        
        $tipo_establecimiento = $request->input('establecimiento');
        $comidaUser = $request->input('comidaUser');
        $ambienteUser = $request->input('ambienteUser');
        $musicaUser = $request->input('musicaUser');
        
        //asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $user->paisActual = $pais;
        $user->ciudadActual = $ciudad;
        $user->zona = $zona;
        $user->genero = $genero;
        $user->direccion_residencia = $direccion;
        $user->fechaNacimiento = $fechaNac;
        $user->telefono = $telefono;
        $user->celular = $celular;
        
        $user->tipo_establecimiento = $tipo_establecimiento;
        $user->tipo_comida = $comidaUser;
        $user->tipo_musica = $ambienteUser;
        $user->tipo_ambiente = $musicaUser;

        //subir imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();

            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambios en la BD
        $user->update();
        
        return redirect()->route('config')
                        ->with(['message'=>'Usuario actualizado correctamente']);
    }


    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    /**
     *  Metodo para ingresar al perfil de un establecimiento.
     *
     * @param [type] $id
     *
     * @return void
     */
    public function profile($id)
    {
        $user = User::find($id);
        $paises = Pais::find($user->paisActual);
        $ambientes = Ambiente::where('id_ambiente', $user->tipo_ambiente)->first();
        $comidas = Comida::where('id_comida', $user->tipo_comida)->first();
        $musica = Musica::where('id_musica', $user->tipo_musica)->first();
        $typeEstablecimiento = Establecimiento::where('id_tipo_establecimiento', $user->tipo_establecimiento)->first();
        
        // Get follow site.
        $followsearch = Follow::where('user_id', $id)->get();
        $arraySite = array();

        foreach ($followsearch as $follow) {
            $site = User::find($follow->site_id);
            array_push($arraySite, $site);
        }
        
        return view('user.profile', [
           'user'=> $user,
           'paises' => $paises,
            'ambientes' => $ambientes,
           'comidas' => $comidas,
           'musica' => $musica,
           'tipoEstablecimiento' =>  $typeEstablecimiento,
           'follows' =>  $arraySite
        ]);
    }

    public function inactiveUser()
    {
        //conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        $user->userActive = 0;
        $user->save();

        $inactive = true;
        return view('auth.login', [
                        'inactive'=> $inactive
                        ]);
    }

    /**
    * Metodo para agregar calificación de estrellas a un establecimiento con el usuario logueado que la está calificando.
    *
    * @param int $image_id
    *
    * @return void
    */
    public function ratingUser($user_id, $ratingData)
    {
        // dd($rating);
        $user = User::find($user_id);
        // dd($user);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $ratingData;
        $rating->rateable_type = "App\User";
        $rating->user_id = \Auth::id();
        // dd($rating);
    
        $user->ratings()->save($rating);
    
        return response()->json([
            'finish'=>true,
            'message'=>'Has dado dislike correctamente'
            ]);
    }

    public function gustosview()
    {
        $users = User::where('role', '3')->orderBy('id', 'desc')->paginate(50);
        $paises = Pais::all();
        $comidas = Comida::all();
        $musica = Musica::all();
        $ambientes = Ambiente::all();
        $typeEstablecimiento = Establecimiento::all();
        
        return view('user.gustos', [

            'users' => $users,
            'paises' => $paises,
            'ambientes' => $ambientes,
            'comidas' => $comidas,
            'musica' => $musica,
            'ambientes' => $ambientes,
            'tipoEstablecimiento' => $typeEstablecimiento
         ]);
    }
    
    public function gustos(Request $request)
    {
        $paises = Pais::all();
        $comidas = Comida::all();
        $musica = Musica::all();
        $ambientes = Ambiente::all();
        $typeEstablecimiento = Establecimiento::all();

        $users = User::where('role', '3');
        
        if ($request['search'] != null && $request['search'] != "") {
            $users->where('nick', 'LIKE', '%'.$request['search'].'%');
        }
        
        if ($request['ambienteUser'] != null && $request['ambienteUser'] != "") {
            $users->where('tipo_ambiente', '=', $request['ambienteUser']);
        }

        if ($request['comidaSite'] != null && $request['comidaSite'] != "") {
            $users->where('tipo_comida', '=', $request['comidaSite']);
        }

        if ($request['typeSite'] != null && $request['typeSite'] != "") {
            $users->where('tipo_establecimiento', '=', $request['typeSite']);
        }

        if ($request['musicaSite'] != null && $request['musicaSite'] != "") {
            $users->where('tipo_musica', '=', $request['musicaSite']);
        }

        if ($request['pais'] != null && $request['pais'] != "") {
            // dd($request);
            $users->where('paisActual', '=', $request['pais']);
        }

        $users->orderBy('id', 'desc')->paginate(50);

        $users = $users->get();
        
        return view('user.gustos', [

           'users' => $users,
           'paises' => $paises,
           'ambientes' => $ambientes,
           'comidas' => $comidas,
           'musica' => $musica,
           'ambientes' => $ambientes,
           'tipoEstablecimiento' => $typeEstablecimiento
        ]);
    }

    /**
     * Metodo para seguir un usuario establecimiento
     *
     * @param Type $var
     *
     * @return void
     */
    public function seguir($site_id)
    {
        // Se busca primeor si ya sigue este usuario.

        $authUser = auth()->user()->id;

        $followsearch = Follow::where('user_id', $authUser)->where('site_id', $site_id)->first();
        
        if (is_null($followsearch)) {
            # create
            $follow = new Follow;
            
            $follow->user_id = $authUser;
            $follow->site_id = $site_id;

            $follow->save();
        }
        
        return response()->json([
            'finish'=>true,
            'message'=>'Has seguido un sitio correctamente'
            ]);
    }

    /**
     * Metodo para seguir un usuario establecimiento
     *
     * @param Type $var
     *
     * @return void
     */
    public function dejarSeguir($site_id)
    {
        // Se borra lo que el usuario tenga.

        $authUser = auth()->user()->id;

        $follow = Follow::where('user_id', $authUser)->where('site_id', $site_id)->delete();

        // $follow->delete();

        return response()->json([
                'finish'=>true,
                'message'=>'Has dejado de seguir correctamente'
                ]);
    }
}
