<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Result;

class UserController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function app()
    {
        $baseUrl = config('app.url');
        return view('users.app', compact('baseUrl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = User::where('name', 'LIKE', '%' . $request->name . '%')->get();
            return response()->json(Result::success($user->toArray()));
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
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->status_id = 1;
            $user->role_id = $request->role_id;
            $user->save();

            if (!isset($user->id))
                return response()->json(Result::error('Error guardando el Usuario.'));
            return response()->json(Result::success([], 'Usuario Guardado Correctamente.'));
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
            $user = User::find($id);

            if (!isset($user->id))
                return response()->json(Result::error('Error el Usuario no Existe.'));


            return response()->json(Result::success(['user' => $user]));
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
            $user = User::find($id);

            if (!isset($user->id))
                return response()->json(Result::error('Error el Usuario no Existe.'));

                $user->name = $request->name;
                $user->email = $request->email;
                $user->status_id = $request->status_id;
                $user->role_id = $request->role_id;
                $user->save();

            return response()->json(Result::success([], 'Usuario Editado Correctamente.'));
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
            $user = User::find($id);
            
            if(!isset($user->id))
                return response()->json(Result::error('Error el usuario no Existe.')); 
                       
                $user->delete();

            return response()->json(Result::success([], 'Usuario Eliminado Correctamente.'));
        } catch(\Exception $e) {
            return response()->json(Result::error('Error,'.$e->getMessage())); 
        }
    }
}
