<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeStatus;
use App\Result;

class TypeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('typeStatuses.app', compact('baseUrl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $typeStatus = TypeStatus::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($typeStatus->toArray()));
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
            $typeStatus = new TypeStatus();
            $typeStatus->name = $request->name;
            $typeStatus->save();

            if (!isset($typeStatus->id))
                return response()->json(Result::error('Error guardando el Tipo de Estatus.'));
            return response()->json(Result::success([], 'Tipo de Estatus Guardada Correctamente.'));
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
            $typeStatus = TypeStatus::find($id);

            if (!isset($typeStatus->id))
                return response()->json(Result::error('Error EL Tipo De Estatus no Existe.'));


            return response()->json(Result::success(['typeStatus' => $typeStatus]));
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
            $typeStatus = TypeStatus::find($id);

            if (!isset($typeStatus->id))
                return response()->json(Result::error('Error el Tipo De Estatus no Existe.'));

                $typeStatus->name = $request->name;
                $typeStatus->save();

            return response()->json(Result::success([], 'Tipo De Estatus Editado Correctamente.'));
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
            $typeStatus = TypeStatus::find($id);
            
            if(!isset($typeStatus->id))
                return response()->json(Result::error('Error el Tipo De Estatus no Existe.')); 
                       
                $typeStatus->delete();

            return response()->json(Result::success([], 'Tipo De Estatus Eliminado Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
    }
}
