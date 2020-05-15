<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\Catalog;
use Illuminate\Support\Facades\Auth;
class TrangChu extends Controller
{

function  __construct()
    {
        
    }

function home(Request $request)
    
    { 
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $products = Product::Where('product_slug', 'LIKE', "%$keyword%")
                ->orWhere('product_name', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('product_views', 'LIKE', "%$keyword%")
                ->orWhere('catalog_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->take(6);
        }
        $catalogs = Catalog::all()->where('catalog_active',true);
        view()->share('catalogs',$catalogs); 

        return view('HomePage',compact('products','catalogs'));

    }


}