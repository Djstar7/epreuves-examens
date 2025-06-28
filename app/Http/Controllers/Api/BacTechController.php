<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacTechModel;
use Illuminate\Http\Request;

class BacTechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // Récupérer toutes les épreuves BAC Technique sans le champ file
            $bacTech = BacTechModel::select('id', 'teacher_id_bac_tech', 'subject_bac_tech', 'year_bac_tech', 'branch_bac_tech', 'price_bac_tech')->get();
            return response()->json($bacTech);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves BAC Technique'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les donnees de la requête
        $request->validate([
            'subject' => 'required|string|max:255', // Valide que le sujet est requis, est une chaîne de caractères et fait max 255 caractères
            'year' => 'required|integer',  // Valide que l'année est requise et est un nombre entier
            'branch' => 'required|string|max:255', // Valide que la branche est requise, est une chaîne de caractères et fait max 255 caractères
            'price' => 'required|numeric', // Valide que le prix est requis et est un nombre
            'file' => 'required|file',     // Valide qu'un fichier est requis et est bien un fichier 
        ]);
        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422); // Retourne une réponse JSON avec les erreurs de validation
        }

        // Créer une nouvelle épreuve BAC Technique avec toutes les données de la requête
        try{
            $bacTech = BacTechModel::create($request->all([
                'teacher_id_bac_tech' => $request->input('teacher_id'), // Récupère l'ID de l'enseignant
                'subject_bac_tech' => $request->input('subject'),
                'year_bac_tech' => $request->input('year'),
                'branch_bac_tech' => $request->input('branch'),
                'price_bac_tech' => $request->input('price'),
                'file_bac_tech' => $request->file('file')->store('bac_tech_files'), // Stocke le fichier et enregistre le chemin
            ]));

            return response()->json($bacTech, 201); // Retourne une réponse JSON avec le nouvel enregistrement et un code de statut 201 (Créé)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve BAC Technique'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher une épreuve BAC Technique spécifique
        try{
            $bacTech = BacTechModel::findOrFail($id);
            return response()->json($bacTech); // Retourne une réponse JSON avec l'épreuve BAC Technique
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve BAC Technique'], 500); // Retourne une réponse JSON avec une erreur
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

        // Mettre à jour l'épreuve BAC Technique avec les nouvelles données
        try{
            $bacTech = BacTechModel::findOrFail($id);
            $bacTech->update($request->all());
            return response()->json($bacTech, 200); // Retourne une réponse JSON avec l'enregistrement mis à jour
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve BAC Technique'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve BAC Technique
        try{
            $bacTech = BacTechModel::findOrFail($id);
            $bacTech->delete();
            return response()->json(['message' => 'Épreuve BAC Technique supprimée avec succès'], 200); // Retourne une réponse JSON avec un message de succès
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve BAC Technique'], 500); // Retourne une réponse JSON avec une erreur
        }
    }
}
