<?php

namespace App\Http\Controllers;

use App\Exports\UserModel;
use App\Imports\ImportUser;
use App\Models\Province;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class UsersController extends Controller
{
    //controller de la page d'acceuil et le dashboard
    public function Home(){
        try {
            $ministere = DB::table('users')->where('usertype','=',2)->count();
            $dirap = DB::table('users')->where('usertype','=',1)->count();
            $camp = DB::table('camp')->count();
            return view('Home')->with('ministere',$ministere)->with('camp',$camp)->with('dirap',$dirap);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    //controller d'affichage de la page utilisateur
    public function Utilisateur(){
        try {
            $users = Users::getUsers();
            return view('Utilisateurs')->with('users', $users);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    //controller pour l'affichage de la page d'ajout d'utilisateur
    public function Addusers()
    {
        try {
            $provinces = Province::getProvince();
            return view('AddUsers')->with('provinces', $provinces);
        }catch (\Exception $exception){
            throw new \Exception( $exception->getMessage());
        }
    }

    //controller pour la suppression d'un utilisateur
    public function DeleteUsers($id)
    {
        try {
            $delete = Users::deleteUsers($id);
            return redirect()->back();
        }catch (\Exception $exception){
        throw new \Exception($exception->getMessage());}
    }
    //controller pour le formulaire d'ajout d'utilisateur
    public  function FormAddUsers(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'matricule' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
                'province' => 'required',
                'position' => 'required',
            ],[
                'name.required' => "Le nom est obligatoire",
                'name.max' => 'Le nom ne doit pas dépasser les 255 caractères',
                'matricule.required' => "Le matricule est obligatoire",
                'matricule.max' => 'Le matricule ne doit pas dépasser les 255 caractères',
                'email.required' => "L'email est obligatoire",
                'email.email' => "L'email doit être une adresse email valide",
                'email.max' => "L'email ne doit pas dépasser les 255 caractères",
                'email.unique' => "Cet email est déjà utilisé",
                'password.required' => "Le mot de passe est obligatoire",
                'password.min' => "Le mot de passe doit contenir au moins 6 caractères",
                'province.required' => "La province est obligatoire",
                'position.required' => "Le poste est obligatoire",
            ]);

            Users::SaveUsers(request('name'),\request('matricule'),request('email'),request('password'),request('province'),request('position'));
//            Users::SaveUsers(request(['name', 'email', 'password', 'province', 'position']));
            return redirect()->route('Utilisateur')->with('success', 'Utilisateur ajouté avec succès.');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()])->withInput();
        }
    }
    //controller pour afficher la page de modification d'users
    public function UpdateUsers($id)
    {
        try {
            $province = DB::table('province')->get();
            $users = DB::table('v_user')->where('id','=',$id)->first();
            return view('UpdateUsers')->with('provinces', $province)->with('users', $users);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour le formulaire de modification de l'utilisateur
    public function FormUpdateUsers(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'id' => 'required',
                'matricule' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6',
                'province' => 'required',
                'position' => 'required',
            ],[
                'name.required' => "Le nom est obligatoire",
                'name.max' => 'Le nom ne doit pas dépasser les 255 caractères',
                'id.required' => "L'identifiant est obligatoire",
                'matricule.required' => "Le matricule est obligatoire",
                'matricule.max' => 'Le matricule ne doit pas dépasser les 255 caractères',
                'email.required' => "L'email est obligatoire",
                'email.email' => "L'email doit être une adresse email valide",
                'email.max' => "L'email ne doit pas dépasser les 255 caractères",
                'password.required' => "Le mot de passe est obligatoire",
                'password.min' => "Le mot de passe doit contenir au moins 6 caractères",
                'province.required' => "La province est obligatoire",
                'position.required' => "Le poste est obligatoire",
            ]);

            Users::UpdateUsers(\request('id'),\request('name'),\request('matricule'),\request('email'),\request('password'),request('province'),\request('position'));
            return redirect()->route('Utilisateur')->with('success','Utilisateur modifier');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()])->withInput();
        }
    }

    //controller pour enregistrer via un fichier csv ou excel
    public function importUsers(Request $request)
    {
        try {
            $file = $request->file('csv_file');
            \Maatwebsite\Excel\Facades\Excel::import(new ImportUser(), $file);
//        Excel::import(new UsersImport, $file);
            return redirect()->route('Utilisateur')->with('success', 'Les utilisateurs ont bien ete enregistrer.');

        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()])->withInput();
        }
    }

    //fonction pour telecharger le model Excel pour les Users
    public function ModelUsers()
    {
        try {
            $data =[
                ['(ex:Jonh Doe, Analamanga,...','exampleEmail@gmail.com','le mot de passe de l\' utilisateur','(ex: DRAP, D.R.A.P, Agent ministere, minister,...','(ex: Antananarivo, Mahajanga, Fianarantsoa,..','son matricule']
            ];
            return \Maatwebsite\Excel\Facades\Excel::download(new UserModel($data), 'Model_utilisateur.xlsx');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

}
