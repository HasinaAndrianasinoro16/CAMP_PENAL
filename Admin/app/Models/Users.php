<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\table;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = ['name','imatricule', 'email', 'password','usertype','province','region'];

//    fonction pour enregistrer un nouveau utilisateurs
    public static function SaveUsers($name,$imatricule, $email, $password, $province, $usertype,$region)
    {
        try {
            $users = new Users();
            $users->name = $name;
            $users->imatricule = $imatricule;
            $users->email = $email;
            $users->password = Hash::make($password);
            $users->usertype = $usertype;
            $users->province = $province;
            $users->region = $region;
            $users->save();
            return $users;
        }catch (\Exception $e){
            throw new \Exception( $e->getMessage());
        }
    }

//    fonction pour supprimer un utilisateur
    public static function deleteUsers($id)
    {
        try {
            $delete = User::destroy($id);
            return $delete;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
    //fonction pour recuperer tous les utilisateurs et leur information
    public static function getUsers()
    {
        try {
            $users = DB::table('v_user')->where('usertype','>',0)->get();
//            $users = DB::table('v_user')->get();
            return $users;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour recuperer les utilisateur avec leur id
    public static function getUsersById($id)
    {
        try {
            $users = DB::table('v_user')->where('id','=',$id)->get();
            return $users;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour faire la modification des informations de l'utilisateur
    public static function UpdateUsers ($id,$name,$imatricule, $email, $password, $province, $usertype, $region)
    {
        try {
            $pass = Hash::make($password);
            $update = DB::table('users')->where('id','=',$id)->
                update([
                    'name' => $name,
                    'imatricule' => $imatricule,
                    'email' => $email,
                    'password' => $pass,
                    'usertype' => $usertype,
                    'province' => $province,
                    'region' => $region,
                ]);
            return $update;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }



    use HasFactory;
}
