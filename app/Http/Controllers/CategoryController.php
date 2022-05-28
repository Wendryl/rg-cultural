<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
                $categories = DB::table('categories')->orderBy('created_at')->paginate($pageSize);
            else
                $categories = DB::table('categories')->orderBy('created_at')->get();

            $categories = Category::simplePaginate($request->query('pageSize'));

            return response()->json($categories, 200);

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

            $category = new Category([
                'name' => $request->input('name'),
            ]);

            $category->save();

            return response()->json($category, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar categoria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {

            $category = Category::find($id);

            if($category == null)
                return response()->json([
                    'message' => 'Categoria não encontrada'
                ], 404);

            return response()->json($category, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        try {

            $category = Category::find($id);

            if($category == null)
                return response()->json([
                    'message' => 'Categoria não encontrada'
                ], 404);

            $category['name'] = $request->input('name');
            $category->save();

            return response()->json($category, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {

            $category = Category::find($id);

            if($category == null)
                return response()->json([
                    'message' => 'Categoria não encontrada'
                ], 404);

            $category->delete();

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
