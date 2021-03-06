<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

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

            $data = json_decode($request->input('data'));

            $this->_validateUser($data);

            $user = new User([
                'name' => $data->name,
                'email' => $data->email,
                'type' => '0',
                'phone' => $data->phone ?? null,
                'access' => (new DateTime())->format('Y-m-d\TH:i:s.u'),
                'street' => $data->street ?? null,
                'number' => $data->number ?? null,
                'neighborhood' => $data->neighborhood ?? null,
                'city' => $data->city ?? null,
                'uf' => $data->uf ?? null
            ]);

            $user->password = Hash::make($data->password);

            if (!is_null($request->file('profile_picture')))
                $user->profile_picture = $this->_saveProfilePic($request, $data->name);

            $user->save();

            return response()->json($user, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar usu??rio',
                'error' => $e->getMessage()
            ], 400);
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
                    'message' => 'Usu??rio n??o encontrado'
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
                    'message' => 'Usu??rio n??o encontrado'
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
                    'message' => 'Usu??rio n??o encontrado'
                ], 404);

            $user['name'] = $request->input('name');
            $user['email'] = $request->input('email');
            $user['phone'] = $request->input('phone') ?? null;
            $user['access'] = (new DateTime())->format('Y-m-d\TH:i:s.u');
            $user['street'] = $request->input('street') ?? null;
            $user['number'] = $request->input('number') ?? null;
            $user['neighborhood'] = $request->input('neighborhood') ?? null;
            $user['city'] = $request->input('city') ?? null;
            $user['uf'] = $request->input('uf') ?? null;
            $user->save();

            return response()->json($user, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }


    public function updateProfilePicture(int $id, Request $request)
    {
        try {

            $user = User::find($id);

            if($user == null)
                return response()->json([
                    'message' => 'Usu??rio n??o encontrado'
                ], 404);

            $user->profile_picture = $this->_saveProfilePic($request, $user->name);

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
                    'message' => 'Usu??rio n??o encontrado'
                ], 404);

            $user->delete();

            return response()->json([
                'message' => 'Usu??rio exclu??do com sucesso'
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
                    'message' => 'Usu??rio ou senha incorretos'
                ], 401);

            $user = User::where('email', $request->email)->get()[0];
            $token = Hash::make(time() . $user->id);
            $user->token = $token;
            $user->save();

            return response([
                'token' => $token,
                'user' => $user
            ], 200);
            /* return response('', 204)->cookie(new Cookie('auth_token', $token)); */ // TODO - Use secure http only token implementation instead of sessionStorage

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $tkn = stripslashes(explode(' ', $request->header('authorization'))[1]);

            $user = User::where('token', '=', $tkn)->first();
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

    private function _saveProfilePic(Request $request, $user_name): string
    {
        $img_path = $request->file('profile_picture');
        $save_path = 'upload/profile-pics/' . Str::slug($user_name) . '.jpg';
        $resized_img = Image::make($img_path)->fit(300);
        $resized_img->save($save_path);
        return $save_path;
    }

    private function _validateUser($user_data)
    {
        if (!property_exists($user_data, 'name'))
            throw new Exception('O campo nome ?? obrigat??rio');

        if (!property_exists($user_data, 'email'))
            throw new Exception('O campo e-mail ?? obrigat??rio');

        if (!property_exists($user_data, 'password'))
            throw new Exception('O campo senha ?? obrigat??rio');

        $user = User::where('email', '=', $user_data->email)->get();

        if (count($user) > 0)
            throw new Exception('Este e-mail j?? est?? sendo utilizado');

    }
}
