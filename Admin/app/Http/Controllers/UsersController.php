<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ]);
            Users::SaveUsers(request('name'),\request('matricule'),request('email'),request('password'),request('province'),request('position'));
//            Users::SaveUsers(request(['name', 'email', 'password', 'province', 'position']));
            return redirect()->route('Utilisateur');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
