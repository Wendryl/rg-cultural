<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

            $pageSize = $request->query('pageSize');

            if ($pageSize != 0)
                $users = User::orderBy('created_at')->paginate($pageSize);
            else
                $users = User::orderBy('created_at')->get();

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
                'type' => '0',
                'phone' => $request->input('phone'),
                'access' => (new DateTime())->format('Y-m-d\TH:i:s.u'),
                'street' => $request->input('street'),
                'number' => $request->input('number'),
                'neighborhood' => $request->input('neighborhood'),
                'city' => $request->input('city'),
                'uf' => $request->input('uf'),
                'type' => $request->input('type')
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

    public function findByEmail(string $email)
    {
        try {

            $user = User::where('email', $email)->first();

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
            $user['email'] = $request->input('email');
            $user['phone'] = $request->input('phone');
            $user['access'] = (new DateTime())->format('Y-m-d\TH:i:s.u');
            $user['street'] = $request->input('street');
            $user['number'] = $request->input('number');
            $user['neighborhood'] = $request->input('neighborhood');
            $user['city'] = $request->input('city');
            $user['uf'] = $request->input('uf');
            $user['type'] = $request->input('type');
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

            $auth_result = Auth::attempt($request->only('email', 'password'));

            if(!$auth_result)
                return response()->json([
                    'message' => 'Usuário ou senha incorretos'
                ], 401);

            $user = User::where('email', $request->email)->get()[0];
            $token = Hash::make(time() . $user->id);
            $user->token = $token;
            $user->save();

            return response([ 'token' => $token ], 200);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $user = User::where('email', $request->email)->get()[0];
            $user->token = null;
            $user->save();

            return response()->json([
                'message' => 'Logout realizado com sucesso!'
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
