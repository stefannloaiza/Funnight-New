<?php

namespace App\Http\Controllers;

use App\Pais;
use App\Role;
use App\User;
use App\Ciudad;
use App\Comida;
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
            $users =User::where('nick', 'LIKE', '%'.$search.'%')
             ->orWhere('name', 'LIKE', '%'.$search.'%')
             ->orWhere('surname', 'LIKE', '%'.$search.'%')
             ->orWhere('email', 'LIKE', '%'.$search.'%')
             ->orderBy('id', 'desc')
            ->paginate(50);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(50);
        }
        return view('user.index', [

           'users' => $users

        ]);
    }

    public function config()
    {
        return view('user.config');
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
       
        //recoger datos del formulario
        $name =$request->input('name');
        $surname =$request->input('surname');
        $nick =$request->input('nick');
        $email =$request->input('email');

        //asignar nuevos valores al objeto del usuario
     
      
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

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

    public function profile($id)
    {
        $user = User::find($id);

        return view('user.profile', [
            'user'=> $user
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
            'message'=>'Has dado dislike correctamente'
        ]);
    }
    
    public function gustos($search= null)
    {
        $ambientes = Ambiente::all();
        $paises = Pais::all();
        $comidas = Comida::all();
        $musica = Musica::all();
        $ambientes = Ambiente::all();
        $typeEstablecimiento = Establecimiento::all();

        if (!empty($search)) {
            $users =User::where('nick', 'LIKE', '%'.$search.'%')
             ->orWhere('paisActual', 'LIKE', '%'.$search.'%')
             ->orWhere('tipo_establecimiento', 'LIKE', '%'.$search.'%')
             ->orWhere('tipo_comida', 'LIKE', '%'.$search.'%')
             ->orWhere('tipo_musica', 'LIKE', '%'.$search.'%')
             ->orWhere('tipo_ambiente', 'LIKE', '%'.$search.'%')
             ->orderBy('id', 'desc')
            ->paginate(50);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(50);
        }
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
}
