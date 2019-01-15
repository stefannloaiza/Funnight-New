<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait UserAuthentication
{
    /**
     * Función que verifica si el usuario esta activo.
     *
     * @return bool
     */
    // public function isUserActive(Request $request)
    // {
    //     $user = \Auth::user();
    //     // dd($request);
    //     // echo '<script>console.log("'.$request->user().'")</script>';
    //     // if ($user->userActive == 1) {
    //     //     return true;
    //     // }

    //     return false;
    // }
}
