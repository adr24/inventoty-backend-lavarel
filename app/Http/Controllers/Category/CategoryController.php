<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return response()->json([
            
            "Categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // VALIDAR DATOS
        $category = $request->validated();
        $category['slug'] = $this->createSlug($category['name']);
        //GUARDAR REQUEST VALIDADO
        Category::create( $category);

        //RETORNAR MENSAJES DE GUARDADO
        return response()->json([
            "message" => "La categoria fue registrada",
            "category" => $category
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $term)
    {
        //
        $category = Category::where('id', $term)
            ->orWhere('slug', $term)
            ->get();

        //VALIDAR DE QUE EXITA LA CATEGORIA
        if ($category->isEmpty())
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        return response()->json([
            "category" => $category[0]
        ]);
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
        $category = Category::find($id);

        if ($category->isEmpty())
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        if($request['name'])
        {
            $request['slug'] = $this->createSlug($request['name']);
        }
        $category->update($request->all());

        return response()->json([
            "message" => "La categoria fue actualizada",
            "category" => $category
        ], 200);
       

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
        $category = Category::find($id);

        if ($category->isEmpty())
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        $category->delete();
        return response()->json([
            "message" => "La categoria fue eliminada",
            "category" => $category
        ], 200);

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
