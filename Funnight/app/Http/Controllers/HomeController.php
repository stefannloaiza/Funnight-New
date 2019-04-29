<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Event;
use App\Image;
use App\Promotion;
use Illuminate\Http\Request;
use App\Traits\ImagesMethods;
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
            # get authenticated user
            $user= \Auth::user();
            # get valid images.
            $images = $this->getImagesValid();
            # verify role
            if ($request->user()->hasRole('user')) {

                foreach ($images as $image) {
                    
                    $image->textType = $this->typePublication($image);
                    $image->vigent = $this->isVigent($image);
                }
                
                // dd($images);

                return view('home', [
                    'images' => $images,
                    'user'=>$user
                ]);
            } elseif ($request->user()->hasRole('site')) {

                $inactivity = false;

                if ($this->withoutInteractionDays() > 4 && $this->withoutInteractionDays() < 7) {
                    
                    # show warning message.
                    $inactivity = true;

                    foreach ($images as $image) {
                    
                        $image->textType = $this->typePublication($image);
                        $image->vigent = $this->isVigent($image);
                    }

                    return view('sites.index', [
                    'inactivity'=> $inactivity,
                    'images' => $images,
                    'user'=>$user
                    ]);
                }
                else {
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
            return view('auth.login');
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
     * Funci?n que verifica si el usuario esta activo.
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

    /**
     * Función que obtiene las imagenes vigentes.
     * 
     */

    public function getImagesValid()
    {
        $validImages = array();

        #get promos valids (get promos that mayor or equals today).
        $promotions = Promotion::where('final_date', '>=', new DateTime())->get();
        foreach ($promotions as $promotion) {
            $image = Image::find($promotion->image_id);
            array_push($validImages, $image);
        }
        
        #get events valids
        $events = Event::where('event_date', '>=', new DateTime())->get();
        foreach ($events as $event) {
            $image = Image::find($event->image_id);
            array_push($validImages, $image);
        }

        # Sort the array for id.
        $validImages = collect($validImages)->sortBy('id')->reverse();
        
        return $validImages;
    }
}
