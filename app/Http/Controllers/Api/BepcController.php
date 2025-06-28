<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BepcModel;
use Illuminate\Http\Request;

class BepcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les épreuves BEPC
        try {
            $bepc = BepcModel::select(['id', 'teacher_id_bepc', 'subject_bepc', 'year_bepc', 'price_bepc'])->get(); // Sélectionne les champs requis
            return response()->json($bepc); // Retourne une réponse JSON avec les épreuves BEPC
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves BEPC'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête

        $request->validate([
            'subject' => 'required|string|max:255', // Valide que le sujet est requis, est une chaîne de caractères et fait max 255 caractères
            'year' => 'required|integer',  // Valide que l'année est requise et est un nombre entier
            'price' => 'required|numeric', // Valide que le prix est requis et est un nombre
            'file' => 'required|file',     // Valide qu'un fichier est requis et est bien un fichier
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422); // Retourne une réponse JSON avec les erreurs de validation
        }
        
        // Créer une nouvelle épreuve BEPC avec toutes les données de la requête   
        try{
            $bepc = BepcModel::create($request->all([
                'teacher_id_bepc' => $request->input('teacher_id'), // Récupère l'ID de l'enseignant
                'subject_bepc' => $request->input('subject'),
                'year_bepc' => $request->input('year'),
                'price_bepc' => $request->input('price'),
                'file_bepc' => $request->file('file')->store('bepc_files'), // Stocke le fichier et enregistre le chemin
            ]));

            return response()->json($bepc, 201); // Retourne une réponse JSON avec le nouvel enregistrement et un code de statut 201 (Créé)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve BEPC'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher une épreuve BEPC spécifique
        try{
            $bepc = BepcModel::findOrFail($id); // Trouver l'épreuve BEPC par ID
            return response()->json($bepc); // Retourne une réponse JSON avec l'épreuve BEPC
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve BEPC'], 500); // Retourne une réponse JSON avec une erreur
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
            'price' => 'required|numeric',
            'file' => 'required|file',
        ]);

        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        // Mettre à jour l'épreuve BEPC avec les nouvelles données
        try {
            $bepc = BepcModel::findOrFail($id);
            $bepc->update($request->all([
                'teacher_id_bepc' => $request->input('teacher_id'),
                'subject_bepc' => $request->input('subject'),
                'year_bepc' => $request->input('year'),
                'price_bepc' => $request->input('price'),
                'file_bepc' => $request->file('file')->store('bepc_files'),
            ]));

            return response()->json($bepc, 200); // Retourne une réponse JSON avec l'enregistrement mis à jour
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve BEPC'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve BEPC
        try {
            $bepc = BepcModel::findOrFail($id);
            $bepc->delete();

            return response()->json(['message' => 'Épreuve BEPC supprimée avec succès'], 200); // Retourne une réponse JSON avec un message de succès
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve BEPC'], 500); // Retourne une réponse JSON avec une erreur
        }
    }
}
