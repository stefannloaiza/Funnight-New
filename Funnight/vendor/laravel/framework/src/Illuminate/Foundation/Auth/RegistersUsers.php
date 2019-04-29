<?php

namespace Illuminate\Foundation\Auth;

use App\Pais;
use App\Role;
use App\Comida;
use App\Musica;
use App\Precio;
use App\Ambiente;
use App\Establecimiento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $roles = Role::where('id', '!=', '1')->get();
        $paises = Pais::all();

        $comidas = Comida::all();
        $musica = Musica::all();
        $ambientes = Ambiente::all();
        $typeEstablecimiento = Establecimiento::all();
        $precio= Precio::all();
        
        return view('auth.register', [
            'roles' => $roles,
            'paises' => $paises,
            'comidas' => $comidas,
            'musica' => $musica,
            'ambientes' => $ambientes,
            'precio' => $precio,
            'tipoEstablecimiento' => $typeEstablecimiento,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd($request);
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        if ($user == null) {
            return redirect()->back()->withErrors(['nick'=>'El usuario o correo ya existen. Por favor intente nuevamente.']);
        }

        event(new Registered($user));
        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        // first initial user.
        // return view('welcome');
    }
}
