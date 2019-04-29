<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Image;
use App\Traits\ImagesMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    use ImagesMethods;
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
        Artisan::call('cache:clear');
        if ($request->user()->authorizeRoles(['user', 'admin','site'])) {
            $user = \Auth::user();
            if ($request->user()->hasRole('user')) {
                $images = Image::orderBy('id', 'desc')->paginate(10);

                foreach ($images as $image) {
                    $image->textType = $this->typePublication($image->id);
                    // dd($image);
                }

                return view('home', [
                    'images' => $images,
                    'user'=>$user
                ]);
            } elseif ($request->user()->hasRole('site')) {
                $inactivity = false;
                if ($this->withoutInteractionDays() > 4 && $this->withoutInteractionDays() < 7) {
                    $images = Image::orderBy('id', 'desc')->paginate(20);
                    # 5 days without interaction
                    $inactivity = true;
                    return view('sites.index', [
                    'inactivity'=> $inactivity,
                    'images' => $images,
                    'user'=>$user
                    ]);
                }
                // elseif ($this->withoutInteractionDays() > 6) {
                //     # 7 days without interaction - inactive
                //     return app(UserController::class)->inactiveUser();
                // }
                else {
                    $images = Image::orderBy('id', 'desc')->paginate(20);
                    // $images = Image::orderBy('id', 'desc')->simplePaginate(3);
                    # not without
                    
                    return view('sites.index', [
                    'inactivity'=> $inactivity,
                    'images' => $images,
                    'user'=>$user
                    ]);
                }
            } else {
                # this is admin
                $users = User::where('role', '2')->orWhere('role', '3')->get();

                return view('admin.index', [
                    'users' => $users
                    ]);
            }

            // new login date.
            $user->lastInteraction = new DateTime();
            $user->save();
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
        $diff = $diff;
        // dd($diff);
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
