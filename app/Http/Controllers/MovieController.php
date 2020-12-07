<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Result;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('movies.app', compact('baseUrl'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $movie = Movie::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($movie->toArray()));
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
            $movie = new Movie();
            $movie->name = $request->name;
            $movie->description = $request->description;
            $movie->user_id = $request->user_id;
            $movie->status_id = 1;
            $movie->save();


            if (!isset($movie->id))
                return response()->json(Result::error('Error guardando la Pelicula.'));
            return response()->json(Result::success([], 'Pelicula Guardada Correctamente.'));
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
            $movie = Movie::find($id);

            if (!isset($movie->id))
                return response()->json(Result::error('Error la Pelicula no Existe.'));


            return response()->json(Result::success(['movie' => $movie]));
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
            $movie = Movie::find($id);

            if (!isset($movie->id))
                return response()->json(Result::error('Error La Pelicula no Existe.'));

            $movie->name = $request->name;
            $movie->description = $request->description;
            $movie->user_id = $request->user_id;
            $movie->status_id = $request->status_id;
            $movie->save();


            return response()->json(Result::success([], 'Pelicula Editada Correctamente.'));
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
            $movie = Movie::find($id);
            
            if(!isset($movie->id))
                return response()->json(Result::error('Error La Pelicula no Existe.')); 
                       
            $movie->delete();

            return response()->json(Result::success([], 'Pelicula Eliminada Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }

    }
}
