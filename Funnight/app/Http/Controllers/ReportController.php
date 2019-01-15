<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;

class ReportController extends Controller
{
    // public function __construct(){
    //     $this->middleware('guest');
    // }

    public function generar()
    {
        return view('reporte');
    }

    public function admin()
    {
        return view('administrar');
    }

    
    public function topusuarios()
    {

        // $user = User::all();

        $likes = \DB::table('images')
        
        ->join('users', 'users.id', '=', 'images.user_id')
        ->join('likes', 'images.id', '=', 'likes.image_id')
        ->select(\DB::raw('count(likes.id) as cantidad, name,surname,nick,description'))
        // ->where('users.id', '=', 'likes.user_id')
        ->groupBy('image_id')
        ->orderBy('cantidad', 'desc')
        ->limit(5)
        ->get();


        // SELECT COUNT(likes.id) as cantidadlikes,users.name, users.surname,users.nick,images.image_path FROM `images`,`users`,`likes`
        // WHERE images.id=likes.image_id
        // AND users.id=images.user_id
        // GROUP BY image_id
        // ORDER BY cantidadlikes DESC
        // LIMIT 5

        


        // DB::table('users')
        //     ->where('name', '=', 'John')
        //     ->where(function ($query) {
        //         $query->where('votes', '>', 100)
        //               ->orWhere('title', '=', 'Admin');
        //     })
        //     ->get();

        //  $likes = Like::all();
 
        $view = \View::make('reporte/topusers', compact('likes'))->render();
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }
}
