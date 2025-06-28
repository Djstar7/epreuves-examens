<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexStudent()
    {
        return response()->json(StudentModel::all());
    }

    /**
     * Store the specified resource in storage.
     */
    public function showStudent($id)
    {
        $usersone = StudentModel::find($id);
        if (!$usersone) {
            return response()->json(['message' => 'Etudiant non trouvé'], 404);
        }

        return response()->json($usersone);
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateStudent(Request $request, string $id)
    {
        $usersone = StudentModel::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ], [
            'name.required'     => 'Le nom est requis.',
            'email.email'       => 'L’email doit être valide.',
            'email.unique'      => 'Cet email est déjà utilisé.',
        ]);

        try{
            if($request->password != null){
                $usersone->update([
                    'name_student' => $request->name,
                    'email_student' => $request->email,
                    'password_student' => Hash::make($request->password)
                ]);
            } else {
                $student->update([
                    'name_student' => $request->name,
                    'email_student' => $request->email,
                ]);
            }
            return response()->json([
                'message' => 'Utilisateur mis à jour avec succès.',
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de l’utilisateur.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyStudent(Request $request)
    {
        $student = StudentModel::where('id', $request->id);
        $student->delete();
        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.'
        ]);
    }






    /**
     * Store a newly created resource in storage.
     */
    public function registerStudent(Request $request)
    {
        // app/Http/Controllers/Api/studentController.php
    try {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:student,email_student',
            'phone' => 'required|regex:/^6[0-9]{8}/',
            'password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/']
        ], [
            'name.required'     => 'Le nom est requis.',
            'email.email'       => 'L’email doit être valide.',
            'email.unique'      => 'Cet email est déjà utilisé.',
            'phone.required'    => 'Le mot numero de telephone est requis',
            'phone.regex'       
            'password.min'      => 'Le mot de passe doit faire au moins 8 caractères.',
            'password.regex'    => 'Le mot de passe doit contenir 1 majuscule, 1 minuscule et 1 chiffre.',
        ]);

        $user = StudentModel::create([
            'name_student'     => $data['name'],
            'email_student'    => $data['email'],
            'role' => 'user',
            'password_student' => Hash::make($data['password']),
        ]);

            // 5) Réponse JSON (201) avec debug SQL en dev
            return response()->json([
                'message' => 'Enregistrement réussi.',
                'user'    => $user,
            ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // erreurs de validation
        return response()->json([
            'errors' => $e->errors()
        ], 422);
    }

    }

    /**
     * Display the specified resource.
     */
    public function loginStudent(Request $request)
    {
        try{
            $data = $request->validate([
                'email'    => 'required|email',
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/'
                ]
            ], [
                'email.email'       => 'L’email doit être valide.',
                'password.min'      => 'Le mot de passe doit faire au moins 8 caractères.',
                'password.regex'    => 'Le mot de passe doit contenir 1 majuscule, 1 minuscule et 1 chiffre.',
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }

        $user = StudentModel::where('email_student', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password_student)) {
            return response()->json([
                'message' => 'Email ou mot de passe incorrect.'
            ], 401);
        }

        // ✅ Crée le token avec Sanctum
        $token = $user->createToken('User-Token', ['user'])->plainTextToken;

        return response()->json([
            'token' => $token, // C’est CE token que tu dois utiliser dans ton frontend
            'name'  => $user->name_student,
            'id' => $user->id,
            'email' => $user->email_student,
            'role' => $user->role
        ]);
    }



}