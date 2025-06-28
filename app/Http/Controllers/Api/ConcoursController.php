<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConcoursModel;
use Illuminate\Http\Request;

class ConcoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Récupérer toutes les épreuves Concours sans le champ file_concours
            $concours = ConcoursModel::select(['id', 'teacher_id_concours', 'subject_concours', 'year_concours', 'school_concours', 'cycle_concours', 'speciality_concours', 'price_concours'])->get();
            return response()->json($concours);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves Concours'], 500);
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
            'school' => 'required|string|max:255',
            'cycle' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Créer une nouvelle épreuve Concours avec toutes les données de la requête
        try {
            $concours = ConcoursModel::create($request->all([
                'teacher_id_concours' => $request->input('teacher_id'),
                'subject_concours' => $request->input('subject'),
                'year_concours' => $request->input('year'),
                'school_concours' => $request->input('school'),
                'cycle_concours' => $request->input('cycle'),
                'speciality_concours' => $request->input('speciality'),
                'price_concours' => $request->input('price'),
                'file_concours' => $request->file('file')->store('concours_files'),
            ]));

            return response()->json($concours, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve Concours'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'épreuve Concours par son ID
        try {
            $concours = ConcoursModel::findOrFail($id);
            return response()->json($concours);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve Concours'], 500);
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
            'school' => 'required|string|max:255',
            'cycle' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Mettre à jour l'épreuve Concours avec les nouvelles données
        try {
            $concours = ConcoursModel::findOrFail($id);
            $concours->update($request->all([
                'teacher_id_concours' => $request->input('teacher_id'),
                'subject_concours' => $request->input('subject'),
                'year_concours' => $request->input('year'),
                'school_concours' => $request->input('school'),
                'cycle_concours' => $request->input('cycle'),
                'speciality_concours' => $request->input('speciality'),
                'price_concours' => $request->input('price'),
                'file_concours' => $request->file('file')->store('concours_files'),
            ]));

            return response()->json($concours, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve Concours'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve Concours
        try {
            $concours = ConcoursModel::findOrFail($id);
            $concours->delete();

            return response()->json(['message' => 'Épreuve Concours supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve Concours'], 500);
        }
    }
}
