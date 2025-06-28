<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProbatoireTechModel;
use Illuminate\Http\Request;

class ProbatoireTechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Récupérer toutes les épreuves Probatoire Technique sans le champ file
            $probatoireTech = ProbatoireTechModel::select(['id', 'teacher_id_probatoire_tech', 'subject_probatoire_tech', 'year_probatoire_tech', 'branch_probatoire_tech', 'price_probatoire_tech'])->get();
            return response()->json($probatoireTech);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves Probatoire Technique'], 500);
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
            'branch' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Créer une nouvelle épreuve Probatoire Technique avec toutes les données de la requête
        try {
            $probatoireTech = ProbatoireTechModel::create($request->all([
                'teacher_id_probatoire_tech' => $request->input('teacher_id'),
                'subject_probatoire_tech' => $request->input('subject'),
                'year_probatoire_tech' => $request->input('year'),
                'branch_probatoire_tech' => $request->input('branch'),
                'price_probatoire_tech' => $request->input('price'),
                'file_probatoire_tech' => $request->file('file')->store('probatoire_tech_files'),
            ]));

            return response()->json($probatoireTech, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve Probatoire Technique'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher une épreuve Probatoire Technique spécifique
        try {
            $probatoireTech = ProbatoireTechModel::findOrFail($id);
            return response()->json($probatoireTech);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve Probatoire Technique'], 500);
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
            'branch' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Mettre à jour l'épreuve Probatoire Technique avec toutes les données de la requête
        try {
            $probatoireTech = ProbatoireTechModel::findOrFail($id);
            $probatoireTech->update($request->all());
            return response()->json($probatoireTech, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve Probatoire Technique'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve Probatoire Technique
        try {
            $probatoireTech = ProbatoireTechModel::findOrFail($id);
            $probatoireTech->delete();
            return response()->json(['message' => 'Épreuve Probatoire Technique supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve Probatoire Technique'], 500);
        }
    }
}
