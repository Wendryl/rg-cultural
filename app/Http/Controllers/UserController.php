<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $users = User::simplePaginate($request->query('pageSize'));

            return response()->json($users, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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

            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone' => $request->input('phone'),
            ]);

            $user->save();

            return response()->json($user, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar usuário',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {

            $user = User::find($id);

            if($user == null)
                return response()->json([
                    'message' => 'Usuário não encontrado'
                ], 404);

            return response()->json($user, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        try {

            $user = User::find($id);

            if($user == null)
                return response()->json([
                    'message' => 'Usuário não encontrado'
                ], 404);

            $user['name'] = $request->input('name');
            $user['phone'] = $request->input('phone');
            $user->save();

            return response()->json($user, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {

            $user = User::find($id);

            if($user == null)
                return response()->json([
                    'message' => 'Usuário não encontrado'
                ], 404);

            $user->delete();

            return response()->json([
                'message' => 'Usuário excluído com sucesso'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {

            if((is_null($request->phone) && is_null($request->email)) || is_null($request->password)) {
                return response()->json([
                    'message' => 'Informe a senha e e-mail para se autenticar'
                ], 400);
            }

            /* $auth_result = Auth::attempt(['email' => $request->email, 'password' => $request->password]) || */
            /*     Auth::attempt(['phone'=> $request->phone, 'password' => $request->password]); */
            $auth_result = Auth::attempt($request->only('email', 'password'));

            if(!$auth_result)
                return response()->json([
                    'message' => 'Usuário ou senha incorretos'
                ], 401);

            return response()->json([
                'message' => 'Usuário autenticado com sucesso!'
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
