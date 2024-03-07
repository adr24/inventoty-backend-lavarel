<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;   
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new ProductCollection( Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //metodo create

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $product = $request->Validated();

        $product['slug'] = $this->createSlug($product['name']);

        $product = Product::create($product);

        return response()->json([
            "message" => "Se guardo el producto",
            "product" => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(string $term)
    {
        //
        $product = Product::where('id', $term)
            ->orWhere('slug', $term)
            ->get();

        //VALIDAR DE QUE EXITA LA CATEGORIA
        if ($product->isEmpty())
        {
            return response()->json([
                "message" => "No se encontro el producto",
            ], 404);
        }

        return new ProductResource($product[0]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $product = Product::find($id);

        if ($category->isEmpty())
        {
            return response()->json([
                "message" => "No se encontro el producto",
            ], 404);
        }

        if($request['name'])
        {
            $request['slug'] = $this->createSlug($request['name']);
        }
        $product->update($request->all());

        return response()->json([
            "message" => "El producto fue actualizado",
            "product" => new ProductResource($product)
        ]);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function createSlug(string $text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/','-',$text);
        $text = trim($text, '-');
        $text = preg_replace('/-+/','-',$text);

        return $text;
    }
}
