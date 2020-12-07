<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Result;

class RentalController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('rentals.app', compact('baseUrl'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $rental = Rental::where('id', 'LIKE', '%' . $request->id . '%')->get();
            return response()->json(Result::success($rental->toArray()));
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
            $rental = new Rental();
            $rental->start_date = $request->start_date;
            $rental->end_date = $request->end_date;
            $rental->total = $request->total;
            $rental->user_id = $request->user_id;
            $rental->status_id = 1;
            $rental->save();

            if (!isset($rental->id))
                return response()->json(Result::error('Error guardando la Renta.'));
            return response()->json(Result::success([], 'Renta Guardada Correctamente.'));
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
            $rental = Rental::find($id);

            if (!isset($rental->id))
                return response()->json(Result::error('Error la Renta no Existe.'));


            return response()->json(Result::success(['rental' => $rental]));
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
            $rental = Rental::find($id);

            if (!isset($rental->id))
                return response()->json(Result::error('Error La Renta no Existe.'));
                
                $rental = Rental::find($id);
                $rental->start_date = $request->start_date;
                $rental->end_date = $request->end_date;
                $rental->total = $request->total;
                $rental->user_id = $request->user_id;
                $rental->status_id = $request->status_id;
                $rental->save();

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
            $rental = Rental::find($id);
            
            if(!isset($rental->id))
                return response()->json(Result::error('Error La Renta no Existe.')); 
                       
                $rental->delete();

            return response()->json(Result::success([], 'Renta Eliminada Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
    }
}
