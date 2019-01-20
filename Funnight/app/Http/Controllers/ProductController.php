<?php
namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }
    public function excel()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Laravel Excel', function ($excel) {
            $excel->sheet('Excel sheet', function ($sheet) {
                //otra opción -> $products = Product::select('name')->get();
                $products = Product::all();
                $sheet->fromArray($products);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }
}
