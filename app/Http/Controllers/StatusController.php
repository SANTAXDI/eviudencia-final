<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Result;


class StatusController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('statuses.app', compact('baseUrl'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $status = Status::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($status->toArray()));
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
            $status = new Status();
            $status->name = $request->name;
            $status->type_status_id = $request->type_status_id;
            $status->save();

            if (!isset($status->id))
                return response()->json(Result::error('Error guardando el Estatus.'));
            return response()->json(Result::success([], 'Estatus Guardada Correctamente.'));
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
            $status = Status::find($id);

            if (!isset($status->id))
                return response()->json(Result::error('Error el Estatus no Existe.'));


            return response()->json(Result::success(['status' => $status]));
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
            $status = Status::find($id);

            if (!isset($status->id))
                return response()->json(Result::error('Error el Estatus no Existe.'));

                $status->name = $request->name;
                $status->type_status_id =$request->type_status_id;
                $status->save();

            return response()->json(Result::success([], 'Estado Editado Correctamente.'));
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
            $status = Status::find($id);
            
            if(!isset($status->id))
                return response()->json(Result::error('Error La Categoría no Existe.')); 
                       
                $status->delete();

            return response()->json(Result::success([], 'Categoría Eliminada Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
        
    }
}
