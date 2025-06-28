<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacGenModel;
use Illuminate\Http\Request;

class BacGenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // Récupérer toutes les épreuves BAC Général sans le champ file
            $bacGen = BacGenModel::select('id', 'teacher_id_bac_gen', 'subject_bac_gen', 
                'year_bac_gen', 'serie_bac_gen', 'price_bac_gen'
            )->get();
            return response()->json($bacGen);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des épreuves BAC Général'], 500);
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
            'serie' => 'required|string|max:255', // Valide que la série est requise, est une chaîne de caractères et fait max 255 caractères
            'price' => 'required|numeric', // Valide que le prix est requis et est un nombre
            'file' => 'required|file',     // Valide qu'un fichier est requis et est bien un fichier 
        ]);
        // Vérifier si les donnees sont valides
        if ($request->fails()) {
            return response()->json($request->errors(), 422); // Retourne une réponse JSON avec les erreurs de validation
        }

        // Créer une nouvelle épreuve BAC Général avec toutes les données de la requête
        try{
            $bacGen = BacGenModel::create($request->all([
                'teacher_id_bac_gen' => $request->input('teacher_id'), // Récupère l'ID de l'enseignant
                'subject_bac_gen' => $request->input('subject'),
                'year_bac_gen' => $request->input('year'),
                'serie_bac_gen' => $request->input('serie'),
                'price_bac_gen' => $request->input('price'),
                'file_bac_gen' => $request->file('file')->store('bac_gen_files'), // Stocke le fichier et enregistre le chemin
            ]));

            return response()->json($bacGen, 201); // Retourne une réponse JSON avec le nouvel enregistrement et un code de statut 201 (Créé)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de l\'épreuve BAC Général'], 500); // Retourne une réponse JSON avec une erreur
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher une épreuve BAC Général spécifique
        try{
            $bacGen = BacGenModel::findOrFail($id);
            return response()->json($bacGen); // Retourne une réponse JSON avec l'épreuve spécifique
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération de l\'épreuve BAC Général'], 500); // Retourne une réponse JSON avec une erreur
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

        // Mettre à jour l'épreuve BAC Général avec les données de la requête
        try{
            $bacGen = BacGenModel::findOrFail($id);
            $bacGen->update($request->all());
            return response()->json($bacGen, 200); // Retourne une réponse JSON avec l'enregistrement mis à jour
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'épreuve BAC Général'], 500); // Retourne une réponse JSON avec une erreur
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer l'épreuve BAC Général
        try{
            $bacGen = BacGenModel::findOrFail($id);
            $bacGen->delete();
            return response()->json(['message' => 'Épreuve BAC Général supprimée avec succès'], 200); // Retourne une réponse JSON avec un message de succès
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'épreuve BAC Général'], 500); // Retourne une réponse JSON avec une erreur
        }
    }
}
