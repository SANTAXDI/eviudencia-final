<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Result;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('roles.app', compact('baseUrl'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $role = Role::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($role->toArray()));
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
            $role = new Role();
            $role->name = $request->name;
            $role->status_id = 1;
            $role->save();
        
            if (!isset($role->id))
                return response()->json(Result::error('Error guardando el Rol.'));
            return response()->json(Result::success([], 'Rol Guardada Correctamente.'));
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
            $role = Role::find($id);

            if (!isset($role->id))
                return response()->json(Result::error('Error el Rol no Existe.'));


            return response()->json(Result::success(['role' => $role]));
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
            $role = Role::find($id);

            if (!isset($role->id))
                return response()->json(Result::error('Error el Rol no Existe.'));

                $role->name = $request->name;
                $role->status_id = $request->status_id;
                $role->save();

            return response()->json(Result::success([], 'El Rol Editado Correctamente.'));
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
            $role = Role::find($id);
            
            if(!isset($role->id))
                return response()->json(Result::error('Error el Rol no Existe.')); 
                       
                $role->delete();

            return response()->json(Result::success([], 'El Rol Eliminado Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
    }
}
