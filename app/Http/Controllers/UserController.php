<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\GalleryPicture;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        return view('admin-dashboard/new-user', [
            'categories' => Category::all()
        ]);
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
                'message' => 'Erro ao cadastrar usuário',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function storeSite(Request $request)
    {
        try {

            $this->_validateUser($request);

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'type' => '0',
                'phone' => $request->phone ?? null,
                'facebook' => $request->facebook ?? null,
                'instagram' => $request->instagram ?? null,
                'twitter' => $request->twitter ?? null,
                'access' => (new DateTime())->format('Y-m-d\TH:i:s.u'),
                'street' => $request->street ?? null,
                'number' => $request->number ?? null,
                'neighborhood' => $request->neighborhood ?? null,
                'city' => $request->city ?? null,
                'uf' => $request->uf ?? null
            ]);

            if($request->created_by === 'admin') {
                $user->password = Hash::make('12345678'); // TODO - Implementar envio de senha para o e-mail do profissional
            } else {
                $user->password = Hash::make($request->password);
            }

            if (!is_null($request->file('profile_picture')))
                $user->profile_picture = $this->_saveProfilePic($request, $request->name);

            $user->save();

            if (!is_null($request->gallery_pictures)) {
                foreach($request->gallery_pictures as $i => $pic) {
                    (new GalleryPicture([
                        'user_id' => $user->id,
                        'url' => $this->_saveGalleryPic($pic, $user->name)
                    ]))->save();
                }
            }

            if (!is_null($request->user_categories)) {
                foreach(json_decode($request->user_categories) as $category) {
                    if (is_numeric($category)) {
                        $category_name = Category::find($category)->get('name');
                        $activity = new Activity([
                            'user_id' => $user->id,
                            'title' => $category_name,
                            'category_id' => $category,
                            'approved' => true,
                            'type' => 0,
                        ]);

                        $activity->save();
                    } else {
                        $new_category = new Category(['name' => $category]);
                        $new_category->save();
                        $activity = new Activity([
                            'user_id' => $user->id,
                            'title' => $new_category->name,
                            'category_id' => $new_category->id,
                            'approved' => true,
                            'type' => 0,
                        ]);

                        $activity->save();
                    }
                }
            }

            if ($request->created_by == 'admin')
                return redirect('admin')->with('message', 'Usuário cadastrado sucesso!');

            if ($request->isMethod('post'))
                return redirect('login')->with('message', 'Usuário cadastrado sucesso!');

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error($error_message);
            if ($request->created_by == 'admin')
                return back()->with('error', "Falha ao cadastrar usuário ($error_message)");

            return redirect('registrar')->with('error', $e->getMessage());
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
    public function edit(int $user_id)
    {
        return view('admin-dashboard/edit-user', [
            'user' => User::find($user_id),
            'categories' => Category::all()
        ]);
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

    public function updateSite(Request $request, int $id = null)
    {
        try {

            if (is_null($id))
                $user = User::find(auth()->user()->id);
            else
                $user = User::find($id);

            $user['name'] = $request->input('name');
            $user['phone'] = $request->input('phone') ?? null;
            $user['access'] = (new DateTime())->format('Y-m-d\TH:i:s.u');
            $user['street'] = $request->input('street') ?? null;
            $user['number'] = $request->input('number') ?? null;
            $user['neighborhood'] = $request->input('neighborhood') ?? null;
            $user['city'] = $request->input('city') ?? null;
            $user['facebook'] = $request->facebook ?? null;
            $user['instagram'] = $request->instagram ?? null;
            $user['twitter'] = $request->twitter ?? null;

            if (!is_null($request->profile_picture))
                $user['profile_picture'] = $this->_saveProfilePic($request, $user->name);

            $user->save();

            if ($request->created_by == 'admin')
                return back()->with('message', 'Usuário atualizado sucesso!');

            return redirect('completar-cadastro')->with('message', 'Usuário atualizado com sucesso!');

        } catch (Exception $e) {
            Log::error($e->getTraceAsString());
            Log::error($e->getMessage());
            return redirect('completar-cadastro')->with('error', 'Erro ao atualizar o usuário!');
        }
    }


    public function updateProfilePicture(int $id, Request $request)
    {
        try {

            $user = User::find($id);

            if($user == null)
            return response()->json([
                    'message' => 'Usuário não encontrado'
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

    public function destroySite(int $id)
    {
        try {

            $user = User::find($id);

            if($user == null)
                return back()->with('error', 'Usuário não encontrado');

            $user->delete();

            return back()->with('message', 'Usuário excluído com sucesso!');

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error($error_message);
            return back()->with('error', $error_message);
        }
    }

    public function loginSite(Request $request)
    {
        try {

            if((is_null($request->phone) && is_null($request->email)) || is_null($request->password)) {
                return redirect('login')->with('error', 'Informe a senha e e-mail para se autenticar');
            }

            $auth_result = Auth::attempt($request->only('email', 'password'));

            if(!$auth_result)
                return redirect('login')->with('error', 'Usuário ou senha incorretos');

            $user = User::where('email', $request->email)->get()[0];
            $token = Hash::make(time() . $user->id);
            $user->token = $token;
            $user->save();

            if ($user->type == 1)
                return redirect('admin');

            return redirect('home');

        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect('login')->with('error', 'Erro ao tentar se autenticar!');
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

    public function logoutSite()
    {
        $user = auth()->user();
        try {
            Auth::logout();
            return redirect('login')->with('message', 'Logout realizado com sucesso!');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            if ($user->type == 1)
                return redirect('admin')->with('error', 'Erro ao realizar logout!');

            return redirect('home')->with('error', 'Erro ao realizar logout!');
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

    private function _saveGalleryPic($img, $user_name): string
    {
        $img_path = $img;
        $save_path = 'upload/gallery-pics/' . Str::random(6) . '.jpg';
        $resized_img = Image::make($img_path);
        $resized_img->save($save_path);
        return $save_path;
    }

    private function _validateUser(Request $user_data)
    {
        if (!property_exists($user_data, 'name') && !$user_data->has('name'))
            throw new Exception('O campo nome é obrigatório');

        if (!property_exists($user_data, 'email') && !$user_data->has('email'))
            throw new Exception('O campo e-mail é obrigatório');

        if (!property_exists($user_data, 'password') && !$user_data->has('password') && !$user_data->has('created_by'))
            throw new Exception('O campo senha é obrigatório');

        $user = User::where('email', '=', $user_data->email)->get();

        if (count($user) > 0)
            throw new Exception('Este e-mail já está sendo utilizado');

    }
}
