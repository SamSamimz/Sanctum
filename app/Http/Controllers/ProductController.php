<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ProductController extends Controller
{
    //__index
    public function index() {
        $product = Product::all();
        return $product;
    }

    //__store 
    public function store (Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $data = Product::create($fields);
        return response()->json([
            'product' => $data,
            'message' => "Product stored successfully!",
        ]);
    }

    //__delete 
    public function delete($id) {
        $product = Product::find($id);
        if($product) {
            $product->delete();
            return response()->json([
                'alert' => 'a product has been deleted!',
            ]);
        }
        return response()->json([
                'alert' => 'the product not found!',
            ]);
    }

}
