<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //controller d'affichage de la page utilisateur
    public function Utilisateur(){
        try {
            $users = Users::getUsers();
            return view('Utilisateurs')->with('users', $users);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
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
}
