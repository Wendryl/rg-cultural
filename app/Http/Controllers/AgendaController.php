<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Exception;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        try {

            $pageSize = $request->query('pageSize');

            if ($pageSize != 0)
                $agendas = DB::table('agendas')->orderBy('created_at')->paginate($pageSize);
            else
                $agendas = DB::table('agendas')->orderBy('created_at')->get();

            return response()->json($agendas, 200);

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

            $agenda = new Agenda([
                'title' => $request->input('title'),
                'date' => $request->input('date'),
                'link' => $request->input('link'),
                'description' => $request->input('description'),
                'location' => $request->input('location')
            ]);

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

            $agenda = Agenda::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Agenda não encontrada'
                ], 404);

            return response()->json($agenda, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Agenda $agenda)
    {
        //
    }

    public function update(int $id, Request $request)
    {
        try {

            $agenda = Agenda::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Agenda não encontrada'
                ], 404);

            $agenda['title'] = $request->input('title');
            $agenda['date'] = $request->input('date');
            $agenda['link'] = $request->input('link');
            $agenda['description'] = $request->input('description');
            $agenda['location'] = $request->input('location');
            $agenda->save();

            return response()->json($agenda, 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {

            $agenda = Agenda::find($id);

            if($agenda == null)
                return response()->json([
                    'message' => 'Agenda não encontrada'
                ], 404);

            $agenda->delete();

            return response()->json([
                'message' => 'Agenda excluída com sucesso'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
