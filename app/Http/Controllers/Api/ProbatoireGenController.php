<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProbatoireGenModel;
use Illuminate\Http\Request;

class ProbatoireGenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les épreuves Probatoire Général
        try {
            $probatoireGen = ProbatoireGenModel::select([
            'id',
            'teacher_id_probatoire_gen',
            'subject_probatoire_gen',
            'year_probatoire_gen', 
            'serie_probatoire_gen',
            'price_probatoire_gen'
            ])->get();
            return response()->json($probatoireGen);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves Probatoire Général'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'subject' => 'required|string|max:255',
            'year' => 'required|integer',
            'serie' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Créer une nouvelle épreuve Probatoire Général avec toutes les données de la requête
        try {
            $probatoireGen = ProbatoireGenModel::create($request->all([
                'teacher_id_probatoire_gen' => $request->input('teacher_id'),
                'subject_probatoire_gen' => $request->input('subject'),
                'year_probatoire_gen' => $request->input('year'),
                'serie_probatoire_gen' => $request->input('serie'),
                'price_probatoire_gen' => $request->input('price'),
                'file_probatoire_gen' => $request->file('file')->store('probatoire_gen_files'),
            ]));

            return response()->json($probatoireGen, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve Probatoire Général'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'épreuve Probatoire Général par son ID
        try {
            $probatoireGen = ProbatoireGenModel::findOrFail($id);
            return response()->json($probatoireGen);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve Probatoire Général'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données de la requête
        $request->validate([
            'subject' => 'required|string|max:255',
            'year' => 'required|integer',
            'serie' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Mettre à jour l'épreuve Probatoire Général avec toutes les données de la requête
        try {
            $probatoireGen = ProbatoireGenModel::findOrFail($id);
            $probatoireGen->update($request->all());
            return response()->json($probatoireGen, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve Probatoire Général'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve Probatoire Général
        try {
            $probatoireGen = ProbatoireGenModel::findOrFail($id);
            $probatoireGen->delete();
            return response()->json(['message' => 'Épreuve Probatoire Général supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve Probatoire Général'], 500);
        }
    }
}
