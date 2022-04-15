<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $brand_id = $request->query('brand_id') ?? null;
        $query = Product::orderBy('updated_at', 'DESC')->with('brand');
        $products = $brand_id ? $query->where('brand_id', $brand_id)->get() : $query->get();

        return response()->json($products);
    }
}
