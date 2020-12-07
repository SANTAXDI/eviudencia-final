<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Result;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('categories.app', compact('baseUrl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $categories = Category::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($categories->toArray()));
        } catch (\Exception $e) {
            return response()->json(Result::error('Error,' . $e->getMessage()));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        try {
            $category = new Category;
            $category->name = $request->name;
            $category->status_id = 1;
            $category->save();

            if (!isset($category->id))
                return response()->json(Result::error('Error guardando la Categoría.'));
            return response()->json(Result::success([], 'Categoría Guardada Correctamente.'));
        } catch (\Exception $e) {
            return response()->json(Result::error('Error,' . $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!isset($category->id))
                return response()->json(Result::error('Error la Categoría no Existe.'));


            return response()->json(Result::success(['category' => $category]));
        } catch (\Exception $e) {
            return response()->json(Result::error('Error,' . $e->getMessage()));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        try {
            $category = Category::find($id);

            if (!isset($category->id))
                return response()->json(Result::error('Error La Categoría no Existe.'));

            $category->name = $request->name;
            $category->save();

            return response()->json(Result::success([], 'Categoría Editada Correctamente.'));
        } catch (\Exception $e) {
            return response()->json(Result::error('Error,' . $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {            
            $category = Category::find($id);
            
            if(!isset($category->id))
                return response()->json(Result::error('Error La Categoría no Existe.')); 
                       
            $category->delete();

            return response()->json(Result::success([], 'Categoría Eliminada Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
    }
}
