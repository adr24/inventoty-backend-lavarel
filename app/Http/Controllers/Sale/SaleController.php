<?php

namespace App\Http\Controllers\Sale;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //instanciar una venta
        $sale = new Sale();
        $sale->client = $request->client;
        $sale->total = $request->total;
        $sale->user_id = $request->user_id;

        $sale->save();

        //obtener arreglo de detalles
        $details = [];
        $products = $request->products;


        //iterar los detalles
        foreach ($products as $product) 
        {
            $details[] = [
                'sale_id' => $sale->id,
                'product_id' => $product['product_id'],
                'product_name' => $product['product_name'],
                'product_slug' => $product['product_slug'],
                'product_price' => $product['product_price'],
                'quantity' => $product['quantity'],

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ];
        //actualizar stock de productos
            $product_updated = Product::find($product['product_id']);

            if ($product['quantity'] > $product_updated['stock'])
            {
                $sale->delete();

                return response()->json([
                    "message" => "No hay suficiente stock. No se realizo la venta"
                ], 400);
            }

            $product_updated['stock'] = $product_updated['stock'] - $product['quantity'];
            $product_updated->update();
        }


        //guardar los detalles de venta
        ProductSale::insert($details);



        return response()->json([
            "message" => "Se registro la venta exitosamente"
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
