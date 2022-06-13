<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CulturalColumn;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CulturalColumnController extends Controller
{
    public function index(Request $request)
    {
        try {

            $pageSize = $request->query('pageSize');

            if ($pageSize != 0)
                $cultural_columns = DB::table('cultural_columns')->orderBy('created_at')->paginate($pageSize);
            else
                $cultural_columns = DB::table('cultural_columns')->orderBy('created_at')->get();

            return response()->json($cultural_columns, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
        try {

            $data = json_decode($request->input('data'));

            $agenda = new CulturalColumn([
                'title' => $data->title,
                'biography' => $data->biography,
            ]);

            if (!is_null($request->file('picture')))
                $agenda->img_url = $this->_savePicture($request, $data->name);

            $agenda->save();

            return response()->json($agenda, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar agenda',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {

            $agenda = CulturalColumn::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Coluna não encontrada'
                ], 404);

            return response()->json($agenda, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(CulturalColumn $agenda)
    {
        //
    }

    public function update(int $id, Request $request)
    {
        try {

            $agenda = CulturalColumn::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Coluna não encontrada'
                ], 404);

            $agenda['title'] = $request->input('title');
            $agenda['img_url'] = $request->input('img_url');
            $agenda['biography'] = $request->input('biography');
            $agenda->save();

            return response()->json($agenda, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateColumnPicture(int $id, Request $request)
    {
        try {

            $ccolumn = CulturalColumn::find($id);

            if($ccolumn == null)
                return response()->json([
                    'message' => 'Coluna não encontrada'
                ], 404);

            $ccolumn->img_url = $this->_savePicture($request, $ccolumn->title);

            $ccolumn->save();

            return response()->json($ccolumn, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {

            $agenda = CulturalColumn::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Coluna não encontrada'
                ], 404);

            $agenda->delete();

            return response()->json([
                'message' => 'Coluna excluída com sucesso'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function _savePicture(Request $request, $column_title): string
    {
        $img_path = $request->file('picture');
        $save_path = 'upload/cultural-column/' . Str::slug($column_title) . '.jpg';
        $resized_img = Image::make($img_path);
        $resized_img->save($save_path);
        return $save_path;
    }
}
