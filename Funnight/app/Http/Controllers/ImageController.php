<?php

namespace App\Http\Controllers;

use App\Like;
use App\Event;
use App\Image;
use App\Comment;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    /**
     * Metodo para guardar
     */
    public function save(Request $request)
    {
        
        // dd($request);
        // asignar valores nuevo objeto
        $user = \Auth::user();

        // save image
        $image = new Image();
        $image->user_id= $user->id;

        // verify promo or event.
        if ($request->tipoPub == 1) {
            # promotion

            // validacion
            $validate = $this->validate($request, [
            'description'=> 'required',
            'image_path' => 'required|mimes:jpeg,png,jpg,mp4|max:10240'
            ]);

            // Recogiendo datos
            $image_path = $request->file('image_path');
            $description = $request->input('description');
        } else {
            # event

            // validacion
            $validate = $this->validate($request, [
            'description2'=> 'required',
            'image_path2' => 'required|mimes:jpeg,png,jpg,mp4|max:10240'
            ]);

            // Recogiendo datos
            $image_path = $request->file('image_path2');
            $description = $request->input('description2');
        }
        
        $image->description = $description;

        //subir fichero
        if ($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();

            //save by mimetype
            if ($image_path->getClientMimeType() == "video/mp4") {
                // dd($image_path);
                # videos...
                Storage::disk('videos')->put($image_path_name, File::get($image_path));
            } else {
                # images...
                Storage::disk('images')->put($image_path_name, File::get($image_path));
            }
            
            $image->image_path = $image_path_name;
        }

        $typePub = $request->tipoPub;
        $image->typePub = $typePub;

        // save
        $image->save();

        // SAVE - PROMOTION or EVENT
        if ($request->tipoPub == 1) {

            # Get datas
            $initialDate = $request->input('iniDate');
            $finalDate = $request->input('finDate');

            # promotion
            $promotion = new Promotion;
            
            $promotion->image_id = $image->id;
            $promotion->initial_date = $initialDate;
            $promotion->final_date = $finalDate;

            $promotion->save();
        } else {

            # Get datas
            $eventDate = $request->input('eventDate');

            # event
            $event = new Event;
            
            $event->image_id = $image->id;
            $event->event_date = $eventDate;
            
            $event->save();
        }

        return redirect()->route('home')->with([
            'message'=> 'La publicación ha sido subida correctamente!!'
        ]);
    }

    public function existImage($filename)
    {
        $exists = Storage::disk('images')->exists($filename);
        if ($exists) {
            # exists
            return "true";
        } else {
            # not exists
            return "false";
        }
    }

    public function getImage($filename)
    {
        $file=Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image =Image::find($id);
        return view('image.detail', [

            'image'=>$image
        ]);
    }

    public function delete($id)
    {
        $user =\Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {
            //Eliminar comentarios
            if ($comments && count($comments) >=1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            //eliminar los likes
            if ($comments && count($likes) >=1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            //eliminar los ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            //eliminar registro de imagen
            $image->delete();
            $message = array('message'=>'La imagen se ha borrado correctamente ');
        } else {
            $message = array('message'=>'La imagen no se ha borrado ');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
        $user =\Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request)
    {

        //validacion
        $validate = $this->validate($request, [

        'description'=> 'required',
        'image_path' => 'image'
    ]);
        //recoger datos
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //conseguir objeto image
        $image = Image::find($image_id);
        $image->description = $description;

        //subir fichero
        if ($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        //actualizar registro
        $image->update();
        return redirect()->route('image.detail', ['id'=> $image_id])
                     ->with(['message'=> 'imagen actualizada con exito']);
    }

    public function countLikesImage($image_id)
    {
        $image = Image::find($image_id);
        // echo "console.log('".$image->likes."');";
        // dd($image->likes);
        $count = count($image->likes);

        return response()->json([
            'numberLike'=>$count
        ]);
    }


    /**
    * Metodo para agregar calificación de estrellas a una imagen con el usuario logueado que la está calificando.
    *
    * @param int $image_id
    *
    * @return void
    */
    public function ratingImage($image_id, $rating)
    {
        // dd($rating);
        $image = Image::find($image_id);

        $rating = new willvincent\Rateable\Rating;
        $rating->rating = $rating;
        $rating->rateable_type = "App\Image";
        $rating->user_id = \Auth::id();

        $image->ratings()->save($rating);
    }

    // public function typePublication(Type $var = null)
    // {
    //     # code...
    // }
}
