<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CapModel;
use Illuminate\Http\Request;

class CapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Récupérer toutes les épreuves CAP sans le champ file_cap
            $cap = CapModel::select('id', 'teacher_id_cap', 'subject_cap', 'year_cap', 'branch_cap', 'price_cap')->get();
            return response()->json($cap);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves CAP'], 500);
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

        // Créer une nouvelle épreuve CAP avec toutes les données de la requête
        try {
            $cap = CapModel::create($request->all([
                'teacher_id_cap' => $request->input('teacher_id'),
                'subject_cap' => $request->input('subject'),
                'year_cap' => $request->input('year'),
                'branch_cap' => $request->input('branch'),
                'price_cap' => $request->input('price'),
                'file_cap' => $request->file('file')->store('cap_files'),
            ]));

            return response()->json($cap, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve CAP'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'épreuve CAP par son ID
        try {
            $cap = CapModel::findOrFail($id);
            return response()->json($cap);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Épreuve CAP non trouvée'], 404);
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

        // Mettre à jour l'épreuve CAP avec les nouvelles données
        try {
            $cap = CapModel::findOrFail($id);
            $cap->update($request->all([
                'teacher_id_cap' => $request->input('teacher_id'),
                'subject_cap' => $request->input('subject'),
                'year_cap' => $request->input('year'),
                'branch_cap' => $request->input('branch'),
                'price_cap' => $request->input('price'),
                'file_cap' => $request->file('file')->store('cap_files'),
            ]));
            return response()->json($cap, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve CAP'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve CAP
        try {
            $cap = CapModel::findOrFail($id);
            $cap->delete();

            return response()->json(['message' => 'Épreuve CAP supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve CAP'], 500);
        }
    }
}
