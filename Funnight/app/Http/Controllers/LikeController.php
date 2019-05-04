<?php

namespace App\Http\Controllers;

use App\Like;
use App\Image;
use Illuminate\Http\Request;
use App\Traits\ImagesMethods;

class LikeController extends Controller
{
    use ImagesMethods;
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = \Auth::user();
        $LikesImages = array();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')
                    ->paginate(5);

        // Set datas to the likes images.
        foreach ($likes as $like ){
            $image = Image::find($like->image->id);

            $image->textType = $this->typePublication($image);
            $image->vigent = $this->isVigent($image);

            array_push($LikesImages, $image);
        }

        return view('like.index', [
            'likes'=> $LikesImages,
            'user'=>$user
        ]);
    }

    public function like($image_id)
    {
        //recoger datos del usuario y la imagen
        $user = \Auth::user();

        //condicion para saber si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();
        

        if ($isset_like == 0) {
            $like= new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //guardar
            $like->save();
       
            return response()->json([
            'like'=>$like
        ]);
        } else {
            return response()->json([
                'message'=>'El like ya existe'
                ]);
        }
    }

    public function dislike($image_id)
    {
        //recoger datos del usuario y la imagen
        $user = \Auth::user();

        //condicion para saber si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();
        

        if ($like) {
       
            // eliminar like
            $like->delete();
       
            return response()->json([
            'like'=>$like,
            'message'=>'Has dado dislike correctamente'
        ]);
        } else {
            return response()->json([
                'message'=>'El like no existe'
                ]);
        }
    }
}
