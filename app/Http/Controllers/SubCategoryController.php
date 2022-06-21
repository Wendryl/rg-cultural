<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use Exception;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $sub_categories = SubCategory::all();

            return response()->json($sub_categories, 200);

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

            $sub_category = new SubCategory([
                'name' => $request->input('name')
            ]);

            $sub_category->category_id = $request->input('category_id');

            $sub_category->save();

            return response()->json($sub_category, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar sub-categoria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {

            $sub_category = SubCategory::find($id);

            if($sub_category == null)
                return response()->json([
                    'message' => 'Sub-categoria não encontrada'
                ], 404);

            return response()->json($sub_category, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function findByCategory(int $id)
    {
        try {

            $sub_categories = SubCategory::where('category_id', $id)->get();

            if($sub_categories == null)
                return response()->json([
                    'message' => 'Nenhuma sub-categoria não encontrada'
                ], 404);

            return response()->json($sub_categories, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $sub_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        try {

            $sub_category = SubCategory::find($id);

            if($sub_category == null)
                return response()->json([
                    'message' => 'Categoria não encontrada'
                ], 404);

            $sub_category['name'] = $request->input('name');
            $sub_category->save();

            return response()->json($sub_category, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {

            $sub_category = SubCategory::find($id);

            if($sub_category == null)
                return response()->json([
                    'message' => 'Categoria não encontrada'
                ], 404);

            $sub_category->delete();

            return response()->json([
                'message' => 'Categoria excluída com sucesso'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
