<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        
        //validacion
        $validate =$this->validate($request, [
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
        return redirect()->route('image.detail', ['id'=>$image_id])
                                ->with([
                                    'message' => 'Has publicado tu comentario correctamente!!'
                                ]);
    }

    public function delete($id)
    {

        //conseguir datos del usuario logueado
        $user= \Auth::user();
        //conseguir objeto del comentario
        $comment= Comment::find($id);
        //comprobar si soy el dueño del comentario o de la publicacion
        if ($user &&($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('image.detail', ['id'=> $comment->image->id])
                ->with([
                    'message' => ' tu comentario ha sido eliminado correctamente!!'
                ]);
        } else {
            return redirect()->route('image.detail', ['id'=>$comment->image->id])
            ->with([
                'message' => ' tu comentario NO ha sido eliminado correctamente!!'
            ]);
        }
    }

    

    // public function update(Request $request)
    // {
    //     //validacion
    //     $validate =$this->validate($request, [
    //         'id'=>'integer|required',
    //         'image_id' => 'integer|required',
    //         'content'=> 'string|required'
    //     ]);

    //     //recoger datos
    //     $user = \Auth::user();
    //     $id = $request->input('id');
    //     $image_id = $request->input('image_id');
    //     $content = $request->input('content');

    //     //conseguir objeto Comentario
    //     $comment = Comment::find($id);
    //     $comment->content = $content;

    //     // asigno mis valores a mi nuevo objeto REVISAR ESTA MINIPARTE
    //     // $comment =new Comment();
    //     // $comment->content = $content;

     
    //     //seteo el comentario de la imagen en el objeto
    //     // $user->comment = $content;
       
    //     //subir fichero
    //     if ($content =! null) {
    //         $comment->content = $content;
    //     } else {
    //         //Ejecutar consulta y cambios en la BD
    //         $comment->update();
    //     }
    //     return redirect()->route('image.detail', ['id'=>$comment->image->id])
    //                     ->with(['message'=>'comentario actualizado correctamente']);
    // }

    public function update($id)
    {
        // $comment = DB::SELECT('SELECT * FROM comments WHERE id = :id', ['id' => $id]);
        $comment = Comment::find($id);
        // dd($comment[0]);
        // return view('actualizarcomentario', compact('comment'));
        return view('actualizarcomentario', ['comment'=>$comment]);
        //return view('actualizarcomentario');
        // return ($comment);
    }

    public function edit(Request $request)
    {
        $data = $request->all();

        $comment = Comment::find($data['id']);

        $comment->content= $data['content'];

        $comment->save();

        return redirect()->route('image.detail', ['id'=> $comment->image->id])
                ->with([
                    'message' => ' tu comentario ha sido actualizado correctamente!!'
                ]);
    }
}
