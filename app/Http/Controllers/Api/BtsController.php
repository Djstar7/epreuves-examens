<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BtsModel;
use Illuminate\Http\Request;

class BtsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Récupérer toutes les épreuves BTS sans le champ file_bts
            $bts = BtsModel::select(['id', 'teacher_id_bts', 'subject_bts', 'year_bts', 'branch_bts', 'speciality_bts', 'price_bts'])->get();
            return response()->json($bts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves BTS'], 500);
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
            'speciality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Créer une nouvelle épreuve BTS avec toutes les données de la requête
        try {
            $bts = BtsModel::create($request->all([
                'teacher_id_bts' => $request->input('teacher_id'),
                'subject_bts' => $request->input('subject'),
                'year_bts' => $request->input('year'),
                'branch_bts' => $request->input('branch'),
                'speciality_bts' => $request->input('speciality'),
                'price_bts' => $request->input('price'),
                'file_bts' => $request->file('file')->store('bts_files'),
            ]));

            return response()->json($bts, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve BTS'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher une épreuve BTS spécifique
        try {
            $bts = BtsModel::findOrFail($id);
            return response()->json($bts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve BTS'], 500);
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
            'speciality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Mettre à jour l'épreuve BTS avec les nouvelles données
        try {
            $bts = BtsModel::findOrFail($id);
            $bts->update($request->all([
                'teacher_id_bts' => $request->input('teacher_id'),
                'subject_bts' => $request->input('subject'),
                'year_bts' => $request->input('year'),
                'branch_bts' => $request->input('branch'),
                'speciality_bts' => $request->input('speciality'),
                'price_bts' => $request->input('price'),
                'file_bts' => $request->file('file')->store('bts_files'),
            ]));

            return response()->json($bts, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve BTS'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve BTS
        try {
            $bts = BtsModel::findOrFail($id);
            $bts->delete();

            return response()->json(['message' => 'Épreuve BTS supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve BTS'], 500);
        }
    }
}
