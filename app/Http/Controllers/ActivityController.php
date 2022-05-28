<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
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
                $activities = DB::table('activities')->orderBy('created_at')->paginate($pageSize);
            else
                $activities = DB::table('activities')->orderBy('created_at')->get();

            return response()->json($activities, 200);

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

            $activity = new Activity([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'value' => $request->input('value'),
                'value_unity' => $request->input('value_unity')
            ]);

            $activity['user_id'] = $request->input('user_id');
            $activity['category_id'] = $request->input('category_id');

            $activity->save();

            return response()->json($activity, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar atividade',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {

            $activity = Activity::find($id);

            if($activity == null)
                return response()->json([
                    'message' => 'Atividade não encontrada'
                ], 404);

            return response()->json($activity, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        try {

            $activity = Activity::find($id);

            if($activity == null)
                return response()->json([
                    'message' => 'Atividade não encontrada'
                ], 404);

            $activity['title'] = $request->input('title');
            $activity['user_id'] = $request->input('user_id');
            $activity['category_id'] = $request->input('category_id');
            $activity['description'] = $request->input('description');
            $activity['value'] = $request->input('value');
            $activity['value_unity'] = $request->input('value_unity');
            $activity->save();

            return response()->json($activity, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {

            $activity = Activity::find($id);

            if($activity == null)
                return response()->json([
                    'message' => 'Atividade não encontrada'
                ], 404);

            $activity->delete();

            return response()->json([
                'message' => 'Atividade excluída com sucesso'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
