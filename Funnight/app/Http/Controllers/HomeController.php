<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->authorizeRoles(['user', 'admin','site'])) {
            if ($this->isUserActive()) {
                # user active
                if ($request->user()->hasRole('user')) {
                    $images = Image::orderBy('id', 'desc')->paginate(10);
    
                    return view('home', [
                        'images' => $images
                    ]);
                } elseif ($request->user()->hasRole('site')) {
                    $inactive = false;
                    if (withoutInteractionDays() == 5) {
                        # 5 days without interaction
                        $inactivity = true;
                        return view('sites.index', [
                        'inactivity'=> $inactivity
                        ]);
                    } elseif (withoutInteractionDays() == 7) {
                        # 7 days without interaction - inactive
                        return Route::controller('inactiveUser', 'UserController');
                    } else {
                        # not without
                        $inactivity = false;
                        return view('sites.index', [
                        'inactivity'=> $inactivity
                        ]);
                    }
                } else {
                    # this is admin
                    return view('admin.index');
                }
            } else {
                # user inactive
                $inactive = true;
                return view('auth.login', [
                        'inactive'=> $inactive
                    ]);
            }
        } else {
            # this is nothing
            return view('welcome');
        }
    }

    public function ratingData(Request $request)
    {
        request()->validate(['rate' => 'required']);

        $post = Image::find($request->id);

        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;

        $post->ratings()->save($rating);

        return redirect()->route("home");
    }

    /**
     * Funcion para saber si el establecimiento lleva dias inactivo.
     *
     * @return numeric
     */
    public function withoutInteractionDays()
    {
        $user = \Auth::user();
        $lastInteraction = $user->lastInteraction;

        $date1 = new DateTime($lastInteraction);
        $date2 = new DateTime();

        $diff = $date1->diff($date2)->days; // numeric = 0,1,...

        return $diff;
    }

    /**
     * Función que verifica si el usuario esta activo.
     *
     * @return bool
     */
    public function isUserActive()
    {
        $user = \Auth::user();

        if ($user->userActive == 1) {
            return true;
        }

        return false;
    }
}