<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Validation\Rule;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $products = Product::all();
        return view('products.index', compact('products', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $brands = Brand::all();
        return view('products.create', compact('brands', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required | min:2',
                'description' => 'required | min:5',
                'price' => 'required | numeric | min:1 | max:9999',
                'image' => 'unique:products',
                'brand_id' => 'nullable|exists:brands,id',
                'colors' => 'nullable | exists:colors,id',
            ],
            [
                'required' => 'il campo :attribute è obbligatorio',
                'description.min' => 'La lunghezza minima è :min',
                'price.min' => 'Il prezzo deve essere minimo :min',
                'unique' => "L \'immagine $request->image è già presente!"

            ]
        );
        $data = $request->all();
        $product = new Product();
        $product->fill($data);
        $product->save();
        if (array_key_exists('colors', $data)) $product->colors()->attach($data['colors']);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $colors = Color::all();
        $colors_product_id = $product->colors->pluck('id')->toArray();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'brands', 'colors_product_id', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(
            [
                'name' => 'required | min:2',
                'description' => 'required | min:5',
                'price' => 'required | numeric | min:1 | max:9999',
                'image' => Rule::unique('products')->ignore($product->id),
            ],
            [
                'required' => 'il campo :attribute è obbligatorio',
                'description.min' => 'La lunghezza minima è :min',
                'price.min' => 'Il prezzo deve essere minimo :min',
                'unique' => "L \'immagine $request->image è già presente!"

            ]
        );

        $data = $request->all();
        $product->update($data);

        if (array_key_exists('colors', $data)) $product->colors()->sync($data['colors']);
        else $product->colors()->detach();

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index');
    }
}
