<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;
use App\Image;
use App\User;
use App\Like;


use Maatwebsite\Excel\Facades\Excel;

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
        ->select(\DB::raw('count(likes.id) as cantidad, name,surname,nick,description,userActive'))
        // ->where('users.id', '=', 'likes.user_id')
        ->groupBy('image_id')
        ->orderBy('cantidad', 'desc')
        ->limit(5)
        ->get();
        
        

        $view = \View::make('reporte/topusers', compact('likes'))->render();
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    //reporte top establecimientos PDF
    
    public function topestablecimiento()
    {
        $users = \DB::table('users')
        
        ->join('ratings', 'users.id', '=', 'ratings.rateable_id')
        ->select(\DB::raw('avg(rating) as stars, name'))
        ->where('role', '=', 3)
        ->groupBy('name')
        ->orderBy('stars', 'desc')
        ->limit(5)
        ->get();

       
  
        $view = \View::make('reporte/topestablecimiento', compact('users'))->render();
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }


    // nuevo reporte
    public function index()
    {
        // $products = Product::all();
        return view('reporte/topusersexcel', compact('topusersexcel'));
    }

    // nuevo reporte 2
    public function index2()
    {
        // $products = Product::all();
        return view('reporte/topestablecimientoexcel', compact('topestablecimientoexcel'));
    }
    public function excel()
    {
        
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Laravel Excel', function ($excel) {
            $likes = \DB::table('images')

        
            ->join('users', 'users.id', '=', 'images.user_id')
            ->join('likes', 'images.id', '=', 'likes.image_id')
            ->select(\DB::raw('count(likes.id) as cantidad, name,surname,nick,description'))
            // ->where('users.id', '=', 'likes.user_id')
            ->groupBy('image_id')
            ->orderBy('cantidad', 'desc')
            ->limit(5)
            ->get();

            $excel->sheet('Excel sheet', function ($sheet) use ($likes) {
                //otra opción -> $products = Product::select('name')->get();
                // esta es la linea original $products = Product::all();
                // $likes = Like::all();
                
                // dd($likes);
               


                // dd($likes);
                //$sheet->fromArray($likes);
                // $sheet->row($likes[0]);

                $sheet->row(1, [
                    'Nombre', 'Apellido', 'Usuario', 'publicacion con mayor
                    cantidad de Likes', 'Nombre de la
                    publicación'
                ]);

                foreach ($likes as $index=> $like) {
                    $sheet->row($index+2, [
                        $like->name, $like->surname, $like->nick, $like->cantidad, $like->description
                    ]);
                }

                $sheet->setOrientation('landscape');
                // dd($likes);
            });
        })->export('xls');
    }

    public function excel2()
    {
        
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Laravel Excel', function ($excel) {
            $users = \DB::table('users')
        
        ->join('ratings', 'users.id', '=', 'ratings.rateable_id')
        ->select(\DB::raw('avg(rating) as stars, name'))
        ->where('role', '=', 3)
        ->groupBy('name')
        ->orderBy('stars', 'desc')
        ->limit(5)
        ->get();

            $excel->sheet('Excel sheet', function ($sheet) use ($users) {
                $sheet->row(1, [
                    'Nombre', 'stars',
                ]);

                foreach ($users as $index=> $user) {
                    $sheet->row($index+2, [
                        $user->name, $user->stars
                    ]);
                }

                $sheet->setOrientation('landscape');
                // dd($likes);
            });
        })->export('xls');
    }
}
