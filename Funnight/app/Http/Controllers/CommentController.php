<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        
        //validacion
        $validate =$this->validate($request,[
            'image_id' => 'integer|required',
            'content'=> 'string|required'
        ]);

        //recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        // asigno mis valores a mi nuevo objeto
        $comment =new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //guardar en base de datos
        $comment->save();


        //redireccion
        return redirect()->route('image.detail',['id'=>$image_id])
                                ->with([
                                    'message' => 'Has publicado tu comentario correctamente!!'
                                ]);
       
    }

     public function delete($id){

        //conseguir datos del usuario logueado
        $user= \Auth::user();
        //conseguir objeto del comentario
        $comment= Comment::find($id);
        //comprobar si soy el dueño del comentario o de la publicacion
        if($user &&($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
                $comment->delete();
                return redirect()->route('image.detail',['id'=>$image_id])
                ->with([
                    'message' => ' tu comentario ha sido eliminado correctamente!!'
                ]);
        }else{

            return redirect()->route('image.detail',['id'=>$image_id])
            ->with([
                'message' => ' tu comentario NO ha sido eliminado correctamente!!'
            ]);
        }
     }
    
}
