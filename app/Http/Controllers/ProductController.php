<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
   public function index(Request $request)
    {

        $buscar = $request->buscar;
        if ($buscar=='') {
            $products = Product::orderBy('name','asc')->paginate(9);
        } else {
            $products = Product::where('name', 'like','%'. $buscar . '%')->orderBy('name','asc')->paginate(9);
        }
        return [
            'pagination' => [
                'total'        => $products->total(),
                'current_page' => $products->currentPage(),
                'per_page'     => $products->perPage(),
                'last_page'    => $products->lastPage(),
                'from'         => $products->firstItem(),
                'to'           => $products->lastItem(),
            ],
            'products' => $products
        ];
 
    }

    public function store(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $product = new Product();
        $product->id = $request->id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = '1';
        $product->save();
    }


    public function update(Request $request)
    {
        //

        $product = Product::findOrFail($request->id);
        $product->id = $request->id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = '1';
        $product->save();
    }

    public function delete(Request $request){
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;
        Product::where('id', '=', $id)->delete();
    }

    public function getProductId($id){
        //if (!$request->ajax()) return redirect('/');

        // $products = Product::where('id','=', $id)
        // ->select->orderBy('name', 'asc')->take(1)->get();


        // return ['product' => $products];
        return Product::where('id',$id)->first();
    }

    
}
